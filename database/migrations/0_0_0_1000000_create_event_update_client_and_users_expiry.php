<?php

use App\Models\ClientStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateEventUpdateClientAndUsersExpiry extends Migration
{

    public function up()
    {
        DB::unprepared($this->dropEvent());
        DB::unprepared($this->createEvent());
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }

    protected function createEvent()
    {
        $now = now()->format('Y-m-d 00:00:00');
        $expired = ClientStatus::S_EXPIRED;

        return <<<EOF
CREATE EVENT `event_update_clients_and_users_expiry` ON SCHEDULE EVERY 1 DAY STARTS '$now' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE clients SET status_id = $expired WHERE expired_at IS NOT NULL AND expires_at < NOW();
    UPDATE clients SET status_id = $expired WHERE expired_at IS NOT NULL AND expires_at < NOW();
END
EOF;
    }

    protected function dropEvent()
    {
        return 'DROP EVENT IF EXISTS event_update_clients_and_users_expiry';
    }
}
