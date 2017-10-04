<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ImglojaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ImglojaTable Test Case
 */
class ImglojaTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ImglojaTable
     */
    public $Imgloja;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.imgloja'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Imgloja') ? [] : ['className' => 'App\Model\Table\ImglojaTable'];
        $this->Imgloja = TableRegistry::get('Imgloja', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Imgloja);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
