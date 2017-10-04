<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Imgloja Model
 *
 * @method \App\Model\Entity\Imgloja get($primaryKey, $options = [])
 * @method \App\Model\Entity\Imgloja newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Imgloja[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Imgloja|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Imgloja patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Imgloja[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Imgloja findOrCreate($search, callable $callback = null, $options = [])
 */
class ImglojaTable extends Table
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

        $this->setTable('imgloja');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->requirePresence('nome', 'create')
            ->notEmpty('nome');

        $validator
            ->allowEmpty('descricao');

        $validator
            ->requirePresence('img', 'create')
            ->notEmpty('img');

        return $validator;
    }
}
