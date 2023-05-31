<?php

use App\DataFixtures\AppFixturesTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class TeamControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private array $teamsData = [
        [
            'name' => 'Team 1',
            'money_balance' => 1000,
            'country_id' => 1,
            'players' => [
                ['name' => 'Player 1', 'surname' => 'Surname 1'],
                ['name' => 'Player 2', 'surname' => 'Surname 2'],
            ],
        ],
        [
            'name' => 'Team 2',
            'money_balance' => 2000,
            'country_id' => 2,
            'players' => [
                ['name' => 'Player 3', 'surname' => 'Surname 3'],
                ['name' => 'Player 4', 'surname' => 'Surname 4'],
            ],
        ],
        [
            'name' => 'Team 3',
            'money_balance' => 3000,
            'country_id' => 3,
            'players' => [
                ['name' => 'Player 5', 'surname' => 'Surname 5'],
                ['name' => 'Player 6', 'surname' => 'Surname 6'],
            ],
        ],
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = self::createClient();

        $container = self::getContainer();
        $entityManager = $container->get('doctrine')->getManager();

        // Truncate all tables
        $connection = $entityManager->getConnection();
        $platform = $connection->getDatabasePlatform();
        $connection->executeStatement('SET FOREIGN_KEY_CHECKS=0');
        $schemaManager = $connection->getSchemaManager();
        $tables = $schemaManager->listTables();
        foreach ($tables as $table) {
            $connection->executeStatement($platform->getTruncateTableSQL($table->getName(), true));
        }
        $connection->executeStatement('SET FOREIGN_KEY_CHECKS=1');

        // Load the fixtures
        $fixture = new AppFixturesTest();
        $fixture->load($entityManager);
    }

    public function testListTeams(): void
    {
        $this->client->request('GET', '/teams');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());
    }

    public function testCreateTeam(): void
    {
        foreach ($this->teamsData as $teamData) {
            $this->client->request('POST', '/teams', [], [], [], json_encode($teamData));

            $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
            $this->assertJson($this->client->getResponse()->getContent());
        }
    }

    public function testTransferPlayer(): void
    {
        foreach ($this->teamsData as $teamData) {
            $this->client->request('POST', '/teams', [], [], [], json_encode($teamData));
        }

        $this->client->request('POST', '/teams/transfer-player', [], [], [], json_encode([
            'from_team' => 1,
            'to_team' => 2,
            'player' => 1,
            'amount' => 500,
        ]));

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());
    }
}