<?php
use Migrations\AbstractMigration;

class RemoveStatusFromRegistrations extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('registrations');
        $table->removeColumn('status');
        $table->update();
    }
}
