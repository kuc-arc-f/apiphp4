<?php
App::uses('Repo', 'Model');

/**
 * Repo Test Case
 */
class RepoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.repo'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Repo = ClassRegistry::init('Repo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Repo);

		parent::tearDown();
	}

}
