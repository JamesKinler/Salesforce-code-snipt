<?php 
$member_id = get_current_user_id();
    $query = "SELECT Id, Account.Name,(SELECT Opportunity.Name, Opportunity.Referral_Program_Member_ID__c, Opportunity.Ambassador_Stage__c, Opportunity.Referred_Email__c FROM Opportunities)FROM Account";
    if($member_id){
      $query .= sprintf(" Where Id IN (SELECT AccountId FROM Opportunity WHERE Referral_Program_Member_ID__c ='%s')", $member_id);
    }
    echo '<table>';
    echo '<tr>';
      echo '<th>' . 'Name' . '</th>';
      echo '<th>' . 'Member ID ' . '</th>';
      echo '<th>' . 'Friends Status ' . '</th>';
      echo '<th>' . 'Friends Email ' . '</th>';
    echo '</tr>';
    $response = $mySforceConnection->query($query);

    foreach($response->records as $record){
      echo '<tr>';
      echo '<td>' . $record->Name . '</td>';

      foreach($record->Opportunities->records as $oppRecord){
        echo '<td>' . $oppRecord->Referral_Program_Member_ID__c . '</td>';
        echo '<td>' . $oppRecord->Ambassador_Stage__c . '</td>';
        echo '<td>' . $oppRecord->Referred_Email__c . '</td>';
      echo '</tr>';
      }
    }

?>
