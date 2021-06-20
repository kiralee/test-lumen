<?php
namespace Tests\Unit\Wager\Repositories;

use App\Domains\Wager\Models\WagerModel;
use App\Domains\Wager\Repositories\Contracts\WagerRepositoryContract;
use Carbon\Carbon;
use Faker\Factory;
use TestCase;

class WagerRepositoryTest extends TestCase
{
    /** @var WagerRepositoryContract */
    protected $wagerRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->wagerRepository = app(WagerRepositoryContract::class);
    }

    public function testCreateWage()
    {
        $faker = Factory::create();
        $wager = [
            'total_wager_value' => $faker->randomNumber(9),
            'odds' => $faker->randomNumber(9),
            'selling_percentage' => $faker->randomNumber(2),
            'selling_price' => $faker->randomFloat(2,0,99999),
            'current_selling_price' => $faker->randomFloat(2,0,99999) ,
            'percentage_sold' => $faker->randomNumber(2),
            'amount_sold' => $faker->randomFloat(2,0,99999),
            'placed_at' => Carbon::now(),
        ];
        $result = $this->wagerRepository->create($wager)->toArray();
        //Is Array
        $this->assertIsArray($result);
        //Has Key
        $this->assertArrayHasKey("total_wager_value",$result);
        $this->assertArrayHasKey("odds",$result);
        $this->assertArrayHasKey("selling_percentage",$result);
        $this->assertArrayHasKey("selling_price",$result);
        $this->assertArrayHasKey("current_selling_price",$result);
        $this->assertArrayHasKey("percentage_sold",$result);
        $this->assertArrayHasKey("amount_sold",$result);
        $this->assertArrayHasKey("placed_at",$result);
        //Correct Value Type
        $this->assertIsInt($result['total_wager_value']);
        $this->assertIsInt($result['odds']);
        $this->assertIsInt($result['selling_percentage']);
        $this->assertIsFloat($result['selling_price']);
        $this->assertIsFloat($result['current_selling_price']);
    }


    public function testGetListWager()
    {
        $maxCreateWager = 2;
        $wager = WagerModel::factory($maxCreateWager)->create()->first();
        $result = $this->wagerRepository->getList(2)->toArray();
        $result = $result["data"];
        $countResult = count($result);
        $this->assertEquals($maxCreateWager,$countResult);
        $this->assertIsArray($result);
        $sampleWager = $result[rand(0,$countResult - 1)];
        //Has Key
        $this->assertArrayHasKey("total_wager_value",$sampleWager);
        $this->assertArrayHasKey("odds",$sampleWager);
        $this->assertArrayHasKey("selling_percentage",$sampleWager);
        $this->assertArrayHasKey("selling_price",$sampleWager);
        $this->assertArrayHasKey("current_selling_price",$sampleWager);
        $this->assertArrayHasKey("percentage_sold",$sampleWager);
        $this->assertArrayHasKey("amount_sold",$sampleWager);
        $this->assertArrayHasKey("placed_at",$sampleWager);
        //Correct Value Type
        $this->assertIsInt($sampleWager['total_wager_value']);
        $this->assertIsInt($sampleWager['odds']);
        $this->assertIsInt($sampleWager['selling_percentage']);
        $this->assertIsFloat($sampleWager['selling_price']);
        $this->assertIsFloat($sampleWager['current_selling_price']);
    }
}

