<?php

namespace Spatie\Translatable;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Spatie\Translatable\Events\TranslationHasBeenSet;
use Spatie\Translatable\Exceptions\AttributeIsNotTranslatable;

trait HasTranslations {
	public function getAttributeValue($key) {

		if (!$this->isTranslatableAttribute($key)) {
			return parent::getAttributeValue($key);
		}

		return $this->getTranslation($key, $this->getLocale());
	}

	public function setAttribute($key, $value) {
		// Pass arrays and untranslatable attributes to the parent method.
		if (!$this->isTranslatableAttribute($key) || is_array($value)) {
			return parent::setAttribute($key, $value);
		}

		// If the attribute is translatable and not already translated, set a
		// translation for the current app locale.
		return $this->setTranslation($key, $this->getLocale(), $value);
	}

	public function translate($key, $locale = '', $useFallbackLocale = true): string {
		return $this->getTranslation($key, $locale, $useFallbackLocale);
	}

	public function getTranslation($key, $locale, $useFallbackLocale = true) {
		$locale = $this->normalizeLocale($key, $locale, $useFallbackLocale);

		$translations = $this->getTranslations($key);

		$translation = $translations[$locale] ?? '';

		if ($this->hasGetMutator($key)) {
			return $this->mutateAttribute($key, $translation);
		}

		return $translation;
	}

	public function getTranslationWithFallback($key, $locale): string {
		return $this->getTranslation($key, $locale, true);
	}

	public function getTranslationWithoutFallback($key, $locale) {
		return $this->getTranslation($key, $locale, false);
	}

	public function getTranslations($key = null): array
	{
		if ($key !== null) {
			$this->guardAgainstNonTranslatableAttribute($key);

			return array_filter(json_decode($this->getAttributes()[$key] ?? '' ?: '{}', true) ?: [], function ($value) {
				return $value !== null && $value !== '';
			});
		}

		return array_reduce($this->getTranslatableAttributes(), function ($result, $item) {
			$result[$item] = $this->getTranslations($item);

			return $result;
		});
	}

	public function setTranslation(string $key, string $locale, $value): self{
		$this->guardAgainstNonTranslatableAttribute($key);

		$translations = $this->getTranslations($key);

		$oldValue = $translations[$locale] ?? '';

		if ($this->hasSetMutator($key)) {
			$method = 'set' . Str::studly($key) . 'Attribute';

			$this->{$method}($value, $locale);

			$value = $this->attributes[$key];
		}

		$translations[$locale] = $value;

		$this->attributes[$key] = $this->asJson($translations);

		event(new TranslationHasBeenSet($this, $key, $locale, $oldValue, $value));

		return $this;
	}

	public function setTranslations($key, $translations): self{
		$this->guardAgainstNonTranslatableAttribute($key);

		foreach ($translations as $locale => $translation) {
			$this->setTranslation($key, $locale, $translation);
		}

		return $this;
	}

	public function forgetTranslation($key, $locale): self{
		$translations = $this->getTranslations($key);

		unset(
			$translations[$locale],
			$this->$key
		);

		$this->setTranslations($key, $translations);

		return $this;
	}

	public function forgetAllTranslations($locale): self{
		collect($this->getTranslatableAttributes())->each(function (string $attribute) use ($locale) {
			$this->forgetTranslation($attribute, $locale);
		});

		return $this;
	}

	public function getTranslatedLocales($key): array
	{
		return array_keys($this->getTranslations($key));
	}

	public function isTranslatableAttribute($key): bool {
		return in_array($key, $this->getTranslatableAttributes());
	}

	public function hasTranslation(string $key, string $locale = null): bool{
		$locale = $locale ?: $this->getLocale();

		return isset($this->getTranslations($key)[$locale]);
	}

	protected function guardAgainstNonTranslatableAttribute(string $key) {
		if (!$this->isTranslatableAttribute($key)) {
			throw AttributeIsNotTranslatable::make($key, $this);
		}
	}

	protected function normalizeLocale($key, $locale, $useFallbackLocale): string {
		if (in_array($locale, $this->getTranslatedLocales($key))) {
			return $locale;
		}

		if (!$useFallbackLocale) {
			return $locale;
		}

		if (!is_null($fallbackLocale = config('translatable.fallback_locale'))) {
			return $fallbackLocale;
		}

		if (!is_null($fallbackLocale = config('app.fallback_locale'))) {
			return $fallbackLocale;
		}

		return $locale;
	}

	protected function getLocale() {
		return config('app.locale');
	}

	public function getTranslatableAttributes(): array
	{
		return is_array($this->translatable)
		? $this->translatable
		: [];
	}

	public function getTranslationsAttribute(): array
	{
		return collect($this->getTranslatableAttributes())
			->mapWithKeys(function (string $key) {
				return [$key => $this->getTranslations($key)];
			})
			->toArray();
	}

	public function getCasts(): array
	{
		return array_merge(
			parent::getCasts(),
			array_fill_keys($this->getTranslatableAttributes(), 'array')
		);
	}
}
