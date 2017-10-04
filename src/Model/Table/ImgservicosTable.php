<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Imgservicos Model
 *
 * @method \App\Model\Entity\Imgservico get($primaryKey, $options = [])
 * @method \App\Model\Entity\Imgservico newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Imgservico[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Imgservico|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Imgservico patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Imgservico[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Imgservico findOrCreate($search, callable $callback = null, $options = [])
 */
class ImgservicosTable extends Table
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

        $this->setTable('imgservicos');
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
            ->requirePresence('img', 'create')
            ->notEmpty('img');

        $validator
            ->allowEmpty('descricao');

        return $validator;
    }
}
