<?php 
require_once(dirname(__FILE__) . '/mp/common.inc.php');

$earnings_count_total = 0;

	$pdo = db_connect();


        $q = $pdo->prepare('
            SELECT id, name, password

            FROM worker

            where id > 5
        ');

        $q->execute();
$y = $q->rowCount();

$x = 0;

for($x = 0; $x < $y; $x++) {



        $row = $q->fetch(PDO::FETCH_ASSOC);
        
        $worker_id = $row['id'];
		$worker_addr = substr($row['name'], -34, 34);

// Earnings

        $q2 = $pdo->prepare('
            SELECT id, worker_id, result

            FROM submitted_work

            WHERE worker_id = :worker_id AND paid = 0
        ');

        $q2->execute(array(':worker_id' => $worker_id));

        //$earnings = (($q->rowCount() / 2) * 0.000184) . " BTC";
		$earnings_count = ($q2->rowCount() / 2);

?>
<?php if ($earnings_count > 271) { 

		$earnings_count_total = $earnings_count_total + $earnings_count;
		
		$earnings_amount = $earnings_count * 0.000114;
		$earnings_amount_total = $earnings_amount_total + $earnings_amount;


   /* $q3 = $pdo->prepare('
            UPDATE submitted_work

            SET paid = 1

            WHERE worker_id = :worker_id
        ');

        $q3->execute(array(':worker_id' => $worker_id));
*/



?>
<?php if (false) { ?>
Earnings for <?php echo $worker_addr; ?> are <?php echo $earnings_count; ?> -  <?php echo $earnings_amount; ?> BTC<br/>
<?php } ?>


"<?php echo $worker_addr; ?>":<?php echo $earnings_amount; ?>, 

<?php
}

}



?>

<?php echo $earnings_count_total; ?>  - <?php echo $earnings_amount_total; ?> BTC





