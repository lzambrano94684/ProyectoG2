<?php

namespace Tests;

use Mockery as m;

use PulkitJalan\Google\Client;

use Revolution\Google\Sheets\Facades\Sheets;

class SheetsTest extends TestCase
{
    /**
     * @var \PulkitJalan\Google\Client
     */
    protected $google;

    public function setUp()
    {
        parent::setUp();

        $this->google = m::mock(Client::class);
        app()->instance(Client::class, $this->google);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testService()
    {
        $this->google->shouldReceive('make')->once()->andReturns(m::mock(\Google_Service_Sheets::class));

        //        Sheets::setService($this->google->make('Sheets'));

        $this->assertInstanceOf(\Google_Service_Sheets::class, Sheets::getService());
    }

    public function testSetAccessToken()
    {
        $this->google->shouldReceive('getCache')->once()->andReturn(m::self());
        $this->google->shouldReceive('clear')->once();
        $this->google->shouldReceive('setAccessToken')->once();
        $this->google->shouldReceive('isAccessTokenExpired')->once()->andReturns(true);
        $this->google->shouldReceive('fetchAccessTokenWithRefreshToken')->once();
        $this->google->shouldReceive('make')->times(2)->andReturns(
            m::mock(\Google_Service_Sheets::class),
            m::mock(\Google_Service_Drive::class)
        );

        $photos = Sheets::setAccessToken([
            'access_token'  => 'test',
            'refresh_token' => 'test',
            'expires_in'    => 0,
        ]);

        $this->assertInstanceOf(\Google_Service_Sheets::class, $photos->getService());
    }
}
