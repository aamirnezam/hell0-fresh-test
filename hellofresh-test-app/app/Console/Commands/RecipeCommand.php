<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Console\Command;
use Nahid\JsonQ\Jsonq;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Http\Request;


class RecipeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fixtures_data:response';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To get response as per requirement';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
        $this->public_path = public_path();
    }

    /**
     * Execute the console command.
     *
     * @return json
     */
    public function handle(){
        
        $this->info('Please wait we are preparing your recipe..... ' . "\n");

        ini_set("memory_limit",-1); // To avoid exhausted memory
        ini_set('max_execution_time', 10000); //16 minutes
        
        /** Importing your JSON data from a file */
        $fixtures_json_data = new Jsonq($this->public_path.'/hf_test_calculation_fixtures.json');

        /** Defining variables/arrays/const */
        $response = array();
        $count_per_recipe_array = array();

        /** Get list of unique recipe */
        $unique_recipe = json_decode($fixtures_json_data->groupBy('recipe')->get(),TRUE);
        
        /** Getting total count for unique recipe */
        $response['unique_recipe_count'] = sizeof($unique_recipe);
        
        /** Perparing set of records for recipe occurrence */
        if(!empty($unique_recipe)){
            foreach (array_keys($unique_recipe) AS $recipe) {
                $recipe_occurrence_data = array();
                $recipe_occurrence_data['recipe']= $recipe;
                $recipe_occurrence_data['count'] =  sizeof($unique_recipe[$recipe]);
                array_push($count_per_recipe_array,$recipe_occurrence_data);
            }
        }

        /** Get list of busiest postcode */
        $busiest_postcode = $this->get_busiest_postcode();

        /** Get deliveries by postcode */
        $deliveries_by_postcode = $this->get_deliveries_by_postcode();

        /** Get matched recipe name */
        $recipe_match_by_name = $this->get_match_by_name();

        /** Preparing final response for output */
        $response['count_per_recipe'] = $count_per_recipe_array;
        $response['busiest_postcode'] = $busiest_postcode;
        $response['count_per_postcode_and_time'] = $deliveries_by_postcode;
        $response['match_by_name'] = $recipe_match_by_name;

        $this->info(json_encode($response));
    }

    public function get_busiest_postcode(){
        
        /** Importing your JSON data from a file */
        $fixtures_json_data = new Jsonq($this->public_path.'/hf_test_calculation_fixtures.json');

        /** Defining variables/arrays/const */
        $busiest_postcode_array = array();
        $previous_greater_postcode_count = 0;

        /** Get list of unique postcode */
        $unique_postcode = json_decode($fixtures_json_data->groupBy('postcode')->get(),TRUE);

        /** Perparing set of records with most delivery in postcode */
        if(!empty($unique_postcode)){
            foreach (array_keys($unique_postcode) AS $postcode) {
                
                /** Checking for most number of delivery  */
                if($previous_greater_postcode_count < sizeof($unique_postcode[$postcode])){
                    $previous_greater_postcode_count = sizeof($unique_postcode[$postcode]);
                    continue;
                }

                $postcode_occurrence_data = array();
                $postcode_occurrence_data['postcode']= $postcode;
                $postcode_occurrence_data['delivery_count'] =  sizeof($unique_postcode[$postcode]);
                
            }
        }
        
        return $postcode_occurrence_data;
    }

    public function get_deliveries_by_postcode(){

        /** Importing your JSON data from a file */
        $fixtures_json_data = new Jsonq($this->public_path.'/hf_test_calculation_fixtures.json');

        /** Defining variables/arrays/const */
        $postcode = "10120";
        $start_time = "10AM";
        $end_time = "3PM";
        $start_time_range = date('H:i', strtotime($start_time));
        $end_time_range = date('H:i', strtotime($end_time));
        $postcode_and_time = array();
        $delivery_count = 0;

        /** Get list of defined postcode */
        $postcode_data = json_decode($fixtures_json_data->where('postcode','=',$postcode)->get(),TRUE);
        
        /** Perparing set of records based on time slot comparison */
        if(!empty($postcode_data)){
            foreach ($postcode_data AS $postcode_details) {
                
                /** converting delivery data into array */
                $postcode_array_data = explode(" ",$postcode_details['delivery']);

                /** converting string to time */
                $delivery_time_start = date('H:i', strtotime($postcode_array_data[1]));
                $delivery_time_end = date('H:i', strtotime($postcode_array_data[3]));
            
                /** Comparing time range */
                if($start_time_range <= $delivery_time_start && $end_time_range >= $delivery_time_end){
                    /** If time lies in given slot then count ++ */
                    $delivery_count++;
                }
                
            }
        }

        $postcode_and_time['postcode']= $postcode;
        $postcode_and_time['from']= $start_time;
        $postcode_and_time['to']= $end_time;
        $postcode_and_time['delivery_count']= $delivery_count;
        
        return $postcode_and_time;
    }

    public function get_match_by_name(){

        /** Importing your JSON data from a file */
        $fixtures_json_data = new Jsonq($this->public_path.'/hf_test_calculation_fixtures.json');
        
        /** Defining variables/arrays/const */
        $search_response_array = array();

        /** Get list of matched recipe word */
        $recipe_search_list = json_decode($fixtures_json_data->where('recipe','contains','Veggie')->orWhere('recipe','contains','Potato')->orWhere('recipe','contains','Mushroom')->get(),TRUE);
       
        /** Perparing set of recipe name */
        if(!empty($recipe_search_list)){
            foreach ($recipe_search_list AS $search_data) {
                array_push($search_response_array,$search_data['recipe']);
            }
        }
        
        return $search_response_array;
    }

}
