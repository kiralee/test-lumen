<?php

namespace Tests\Unit\Wager\Repositories;

use App\Domains\Wager\Models\WagerModel;
use App\Domains\Wager\Repositories\Contracts\WagerRepositoryContract;
use Carbon\Carbon;
use Faker\Factory;
use TestCase;

class WagerControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateWageActionSuccess()
    {
        $postData = [
            'total_wager_value' => 1111,
            'odds' => 234,
            'selling_percentage' => 89,
            'selling_price' => 999999.99,
        ];
        $response = $this->post("/wagers/",$postData);
        $this->assertResponseStatus(201);
        $this->assertJson($response->response->getContent());
        $jsonData = json_decode($response->response->getContent(),true);
        $dataWager = $jsonData["data"];
        $this->assertArrayHasKey("total_wager_value",$dataWager);
        $this->assertArrayHasKey("odds",$dataWager);
        $this->assertArrayHasKey("selling_percentage",$dataWager);
        $this->assertArrayHasKey("selling_price",$dataWager);
        $this->assertArrayHasKey("current_selling_price",$dataWager);
        $this->assertArrayHasKey("percentage_sold",$dataWager);
        $this->assertArrayHasKey("amount_sold",$dataWager);
        $this->assertArrayHasKey("placed_at",$dataWager);
        //Correct Value Type
        $this->assertIsInt($dataWager['total_wager_value']);
        $this->assertIsInt($dataWager['odds']);
        $this->assertIsInt($dataWager['selling_percentage']);
        $this->assertIsFloat($dataWager['selling_price']);
        $this->assertIsFloat($dataWager['current_selling_price']);
    }
    public function testCreateWageActionFailBadReqest()
    {
        $faker = Factory::create();
        $postData = [
            'total_wager_value' => -1111,
            'odds' => -1111,
            'selling_percentage' => 200,
            'selling_price' => 999999999999.99,
        ];
        $response = $this->post("/wagers/",$postData);
        $this->assertResponseStatus(422);
        $this->assertJson($response->response->getContent());
        $messages = json_decode($response->response->getContent(),true);
        $this->assertArrayHasKey("total_wager_value",$messages);
        $this->assertArrayHasKey("odds",$messages);
        $this->assertArrayHasKey("selling_percentage",$messages);
        $this->assertArrayHasKey("selling_price",$messages);

        foreach($messages as $key => $value)
        {
            if($key === "total_wager_value"){
                $this->assertEquals("The total wager value must be greater than 0.",$value[0]);
            }
            if($key === "selling_price"){
                $this->assertEquals("The selling price must be between 0 and 999999.99.",$value[0]);
            }
            $this->assertIsString($value[0]);
        }
    }

    public function testBuyWager()
    {
        /** @var WagerModel $wager */
        $wager = WagerModel::factory(1)->create()->first();
        $faker = Factory::create();
        $postData = [
            'buying_price' => $faker->randomFloat(2,0,9999.99),
        ];
        $response = $this->post("/wagers/buy/".$wager->id,$postData);
        $this->assertResponseStatus(201);
        $this->assertJson($response->response->getContent());
        $jsonData = json_decode($response->response->getContent(),true);
        $dataOrder = $jsonData["data"];
        $this->assertArrayHasKey("buying_price",$dataOrder);
        $this->assertArrayHasKey("wager_id",$dataOrder);
        $this->assertArrayHasKey("id",$dataOrder);
        $this->assertArrayHasKey("bought_at",$dataOrder);
        $this->assertEquals($wager->id,$dataOrder["wager_id"]);
        //Correct Value Type
        $this->assertIsInt($dataOrder['wager_id']);
        $this->assertIsFloat($dataOrder['buying_price']);
    }
    public function testBuyWagerFailWith500()
    {
        /** @var WagerModel $wager */
        $wager = WagerModel::factory(1)->create()->first();
        $faker = Factory::create();
        $postData = [
            'buying_price' => $faker->randomFloat(2,0,9999.99),
        ];
        //Query with wager id that not belong to wagers table
        $randomId = 9999999999999;
        $response = $this->post("/wagers/buy/".$randomId,$postData);
        $this->assertResponseStatus(500);
        $this->assertJson($response->response->getContent());
        $jsonData = json_decode($response->response->getContent(),true);
        $dataOrder = $jsonData["data"];
        $error = $jsonData["error"];
        $this->assertEmpty($dataOrder);
        $this->assertArrayHasKey("message",$error);
        $this->assertNotEmpty($error);
    }

    public function testGetGetListWager()
    {
        /** @var WagerModel $wager */
        $maxCreateWager = 5;
        $wager = WagerModel::factory($maxCreateWager)->create()->first();
        $response = $this->get("/wagers?page=1&limit=$maxCreateWager");
        $this->assertResponseStatus(200);
        $this->assertJson($response->response->getContent());
        $jsonData = json_decode($response->response->getContent(),true);
        $dataWager = $jsonData["data"];
        $countWager = count($dataWager);
        $this->assertEquals($maxCreateWager,$countWager);

        $sampleWager = $dataWager[rand(0,$countWager - 1)];
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
        $this->assertIsNumeric($sampleWager['selling_price']);
        $this->assertIsNumeric($sampleWager['current_selling_price']);
    }

}

