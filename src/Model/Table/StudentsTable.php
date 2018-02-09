<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Students Model
 *
 * @method \App\Model\Entity\Student get($primaryKey, $options = [])
 * @method \App\Model\Entity\Student newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Student[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Student|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Student[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Student findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StudentsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('students');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('document1')
            ->maxLength('document1', 255)
            ->requirePresence('document1', 'create')
            ->notEmpty('document1');

        $validator
            ->scalar('document2')
            ->maxLength('document2', 255)
            ->requirePresence('document2', 'create')
            ->notEmpty('document2');

        $validator
            ->date('birthdate')
            ->requirePresence('birthdate', 'create')
            ->notEmpty('birthdate');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 255)
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

       // CakePHP CPF validator (thanks to https://github.com/gspaiva/cpfvalidator)
       $validator
            ->add('document1','custom',
                ['rule'=>
                    function($cpf)
                    {   

                        // Check cpf
                        if(empty($cpf)) {
                            return false;
                        }
                     
                        // Remove possible mask
                        $cpf = preg_replace('/[^0-9]/', '', $cpf);
                        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
                         
                        // Check digits number
                        if (strlen($cpf) != 11) {
                            return false;
                        }
                        
                        // Check invalid sequences
                        else if ($cpf == '00000000000' || 
                            $cpf == '11111111111' || 
                            $cpf == '22222222222' || 
                            $cpf == '33333333333' || 
                            $cpf == '44444444444' || 
                            $cpf == '55555555555' || 
                            $cpf == '66666666666' || 
                            $cpf == '77777777777' || 
                            $cpf == '88888888888' || 
                            $cpf == '99999999999') {
                            return false;
                         
                         // Calculate verification digit
                         } else {   
                             
                            for ($t = 9; $t < 11; $t++) {
                                 
                                for ($d = 0, $c = 0; $c < $t; $c++) {
                                    $d += $cpf{$c} * (($t + 1) - $c);
                                }
                                $d = ((10 * $d) % 11) % 10;
                                if ($cpf{$c} != $d) {
                                    return false;
                                }
                            }
                     
                            return true;
                        }
                        
                    },
                    
                    // Error message
                    'message' => __('Document1 is invalid')

                ]);


        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {

        // Define that document1 field (CPF) is unique
        $rules->add($rules->isUnique(['document1']));
        return $rules;

    }

}
