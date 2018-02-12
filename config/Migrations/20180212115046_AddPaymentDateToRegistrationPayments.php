<?php
use Migrations\AbstractMigration;

class AddPaymentDateToRegistrationPayments extends AbstractMigration
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
        $table = $this->table('registration_payments');
        $table->addColumn('payment_date', 'date', [
            'default' => null,
            'null' => true,
        ]);
        $table->update();
    }
}
