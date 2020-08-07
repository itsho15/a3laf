<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OptimizeDBCron extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'optimizeDb:cron';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$now = \Carbon\Carbon::now();

		$notifications = \DB::table('notifications')
			->where('read_at', '!=', null)
			->where('created_at', '<', $now->subDays(15))->delete();

		\Log::info("optimizeDb is working fine!");

		/*
			           Write your database logic we bellow:
			           Item::create(['name'=>'hello new']);
		*/

		$this->info('optimizeDb:Cron Cummand Run successfully!');
	}
}