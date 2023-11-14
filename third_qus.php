<?php 

function check_file($file_name)
{
    $filecontent = file_get_contents($file_name);

    $lowercase = strtolower($filecontent);

    $words_data = preg_split('/[^a-z]+/',$lowercase, -1,PREG_SPLIT_NO_EMPTY);

    return $words_data;
}


function getoutputs($words_data)
{
    $tot_no_words = 0;
    $tot_no_unq_words = array();
    $word_freq = array();
    $long_word = array();

    foreach($words_data as $words)
    {
        $tot_no_words++;

        if(!isset($tot_no_unq_words[$words]))
        {
            $tot_no_unq_words[$words] = true;
        }

        if(!isset($word_freq[$words]))
        {
            $word_freq[$words] = 1;
        } else {
            $word_freq[$words]++;
        }

        $long_word[$words] = strlen($words);
    }

    arsort($word_freq);

    $get_top_five_freq = array_slice($word_freq,0,5, true);

    arsort($long_word);

    $get_top_five_length_wrd = array_slice($long_word,0,5, true);

    return array(
        'total_words' => $tot_no_words,
        'unique_words' => count($tot_no_unq_words),
        'five_wrd_frequencies' => $get_top_five_freq,
        'five_length_words' => $get_top_five_length_wrd
    );
}

function view_data($result)
{
    print "<b>Total number of words:</b> {$result['total_words']} <br><br>";
    print "<b>Total number of unique words:</b> {$result['unique_words']} <br><br>";

    print "<b>Top 5 most common words and their frequencies:</b> <br>";
    foreach ($result['five_wrd_frequencies'] as $word => $frequency) {
        print "{$word}: {$frequency} times\n <br>";
    }

    print "<br><b>Top 5 longest words:</b> <br><br>";
    foreach ($result['five_length_words'] as $word => $length) {
        print "{$word}: {$length} characters\n <br>";
    }
}

$filename = 'third.txt'; 
$words = check_file($filename);
$result = getoutputs($words);
view_data($result);