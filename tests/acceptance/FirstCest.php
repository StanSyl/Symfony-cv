<?php namespace App\Tests;
use App\Tests\AcceptanceTester;

class FirstCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }
    
    
     public function frontpageWorks(AcceptanceTester $I)
    {
        $I ->amOnpage('/lucky/number');
        $I  ->see('Rambo');
    }   
    
    
}
