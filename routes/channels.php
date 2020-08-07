<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
 */

Broadcast::channel('App.User.{id}', function ($user, $id) {
	return (int) $user->id === (int) $id;
});

Broadcast::channel('conversation.{id}', function ($user, $id) {
	return \App\Models\Conversation::where('to_id', auth()->user()->id)->first()
	|| \App\Models\Conversation::where('from_id', auth()->user()->id)->first();
});

Broadcast::channel('chat', function ($user) {
	return \App\Models\Conversation::where('to_id', $user->id)->first()
	|| \App\Models\Conversation::where('from_id', $user->id)->first();
});