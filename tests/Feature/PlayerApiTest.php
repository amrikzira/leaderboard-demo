<?php

namespace Tests\Feature;

use App\Player;
use Tests\TestCase;

class PlayerApiTest extends TestCase
{
    /**
     * Test case for creating a new player
     *
     */
    public function test_can_create_player()
    {
        $playerData = [
            "name" => $this->faker->name,
            "age" => $this->faker->randomNumber(2),
            "address" => $this->faker->address,
        ];

        $this->postJson('api/createPlayer', $playerData)
            ->assertStatus(201);
    }

    /**
     * Test case for fetching all players
     *
     */
    public function test_can_fetch_players()
    {
        $this->get('api/getAllPlayers')
            ->assertStatus(200);
    }

    /**
     * Test case for updating a specific player
     *
     */
    public function test_can_update_specific_player()
    {
        $player = factory(Player::class)->create();
        $playerData = [
            "id" => $player->id,
            "operationType" => "inc",
        ];
        $this->put('api/updatePointCount', $playerData)
            ->assertStatus(200);
    }

    /**
     * Test case for deleting a specific player
     *
     */
    public function test_can_delete_specific_player()
    {
        $player = factory(Player::class)->create();
        $this->delete('api/deletePlayer', [
            'id' => $player->id,
        ])
            ->assertStatus(202);
    }
}
