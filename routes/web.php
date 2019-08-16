<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Imports\NominationImport;
use App\Nomination;

Route::get('/import', function () {
    // Import BEA Acceptances
    $fName = 'bea-acceptance-form-2019-2019-08-16.csv';

    Excel::load('storage/app/'. $fName, function ($reader) {
        // Array of Awards
        $awards = array(
          'association_of_the_year',
          'business_of_the_year_10_or_more_employees',
          'business_of_the_year_under_10_employees',
          'emerging_business_award',
          'innovator_award',
          'community_builder_award',
          'business_citizen_award',
          'young_professional_of_the_year'
        );
        // $reader->noHeading();
        // Getting all results
        $results = $reader->get();
        // dd($reader->first());
        foreach ($results as $row) {
            // For some reason the first row refuses to be imported
            $award = "innovator_award";
            $nomination = new Nomination;
            $nomination->business_name = $row->business_name;
            $nomination->first_name = $row->name_first;
            $nomination->last_name = $row->name_last;
            $nomination->in_dufferin = $row->are_you_located_in_dufferin_caledon_or_erin;
            $nomination->is_member = $row->are_you_a_dbot_member;
            $nomination->nomination = $award;
            $nomination->years_in_business = $row->as_of_october_22_2019_your_business_has_been_in_operation_for;
            $nomination->full_time_employees = $row->number_of_full_time_equivalent_employees;
            $nomination->is_non_profit = $row->nn_profit;
            $nomination->is_for_profit = $row->for_profit;
            $nomination->five_years = $row->five_or_more_years;
            $nomination->under_40 = $row->under_forty;
            $nomination->confirmation_employees_10 = $row->wrong_10;
            $nomination->confirmation_employees_under_10 = $row->wrong_19;
            $nomination->save();

            foreach ($awards as $award) {
                if ($row->$award) {
                    $nomination = new Nomination;
                    $nomination->business_name = $row->business_name;
                    $nomination->first_name = $row->name_first;
                    $nomination->last_name = $row->name_last;
                    $nomination->in_dufferin = $row->are_you_located_in_dufferin_caledon_or_erin;
                    $nomination->is_member = $row->are_you_a_dbot_member;
                    $nomination->nomination = $award;
                    $nomination->years_in_business = $row->as_of_october_22_2019_your_business_has_been_in_operation_for;
                    $nomination->full_time_employees = $row->number_of_full_time_equivalent_employees;
                    $nomination->is_non_profit = $row->nn_profit;
                    $nomination->is_for_profit = $row->for_profit;
                    $nomination->five_years = $row->five_or_more_years;
                    $nomination->under_40 = $row->under_forty;
                    $nomination->confirmation_employees_10 = $row->wrong_10;
                    $nomination->confirmation_employees_under_10 = $row->wrong_19;

                    $nomination->save();
                }
            }
        }
    });

    dd(Nomination::all()->toArray());
});

Route::get('/export', function () {
    // Export BEA Acceptances in friendly format
    Excel::create('Acceptances', function ($excel) {
        $excel->sheet('Sheet1', function ($sheet) {
            $sheet->fromArray(Nomination::all()->toArray());
        });
    })->export('xls');
});

Route::get('/', function () {
    return view('welcome');
});
