<?php
namespace Drupal\Tests\umd_terp_base\Unit;
use Drupal\Tests\UnitTestCase;
use Drupal\umd_terp_base\UmdTerpBase;

/**
 * Tests basic custom PHP functions for umd_terp_base.
 *
 * @group umd_terp_base
 */
class UmdTerpBaseTest extends UnitTestCase {

  protected $umdterpbase;
  /**
   * Before a test method is run, setUp() is invoked.
   * Create new umdterpbase object.
   */
  public function setUp() {
    $this->umdterpbase = new UmdTerpBase();
  }

  /**
   * @covers Drupal\umd_terp_base\UmdTerpBase::middleware_get
   */
  public function testMiddlewareGet() {
    $currentDate = date('Y-m-d') . 'T00:00:00';
    $query = 'adv_events(date_one: {field: \"start_date\", date: \"' . $currentDate . '\", operator: \">=\"}, page: {limit: 3, offset: 0}';
    $query .= ' ) { data { title slug all_day start_date { formatted_short time } end_date { time } campus_location { name } }}';
    $data = $this->umdterpbase->middleware_get($query);
    $this->assertArrayHasKey('data', $data);
    $this->assertEquals(3,count($data['data']['adv_events']['data']));
  }

  /**
   * @covers Drupal\umd_terp_base\UmdTerpBase::middleware_get_taxonomy
   */
  public function testMiddlewareGetTaxonomy() {
    $data = $this->umdterpbase->middleware_get_taxonomy('audience');
    $this->assertArrayHasKey('data', $data);
    $this->assertGreaterThanOrEqual(1,count($data['data']));
  }

  /**
   * Once test method has finished running, whether it succeeded or failed, tearDown() will be invoked.
   * Unset the $umdterpbase object.
   */
  public function tearDown() {
    unset($this->umdterpbase);
  }

}
