<?
$pushToAndroid=new PushNotificationToAndroid();


        $acceptResponse=array();
		$acceptResponse['notifFromId']=98;
		$acceptResponse['notifFromName']='userName123';
		$acceptResponse['fromDes']='fshdkjhasf';
		$acceptResponse['message']='this is message';
		$acceptResponse['notif_date']='31-10-2017';

		$mesg=json_encode($acceptResponse);

 echo $pushToAndroid->sendnotification($mesg);


class PushNotificationToAndroid {
	
public function sendnotification($msg){

		

			$msgJsonData=$msg;
			$title=$title="successfully accepted ";
			$userId=$userid=1;

			$path_to_fcm="https://fcm.googleapis.com/fcm/send";

			$server_key="AAAA6pWtd9Q:APA91bFnzjGV8w418oJzDXqEvIYWsUm139Up7_Ftx6VNxGaeO98jShpyG8Z7D802v4_zN58chZFlE3u_H3XjQ85N25C6dF90P3NTRmhgmigqJvpVPlLz-G5UksWDu7FMmoahWErVR1RF";

			//$sql="select deviceid from users where  id='".$userId."'";
			
			//$results=mysqli_query(GFHConfig::$link,$sql);
			//$row=mysqli_fetch_row($results);
			//$key=$row[0];

			$key="f9y4YK3vMPA:APA91bE_mr7tPemP54dhMkeA-3p3H8WZk_VRcF2J7uKNVpElP-3d6PlfaoTaGg5thmgO1Vi7FbnzCFtgWhX3DCcCK3A3MoLf-Jo50qeQ6K64AsjDcg5rcgsXfy6SdzFpjoEB9tA4uu2_";

			$headers=array('Authorization:key='.$server_key,'Content-type:application/json');

			$fields=array('to'=>$key,'data'=>array('title'=>$title,'body'=>$msgJsonData));

			$payload=json_encode($fields);
			$curl_session=curl_init();
			curl_setopt($curl_session,CURLOPT_URL,$path_to_fcm);
			curl_setopt($curl_session,CURLOPT_POST,true);
			curl_setopt($curl_session,CURLOPT_HTTPHEADER,$headers);
			curl_setopt($curl_session,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl_session,CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($curl_session,CURLOPT_IPRESOLVE,CURL_IPRESOLVE_V4);
			curl_setopt($curl_session,CURLOPT_POSTFIELDS,$payload);

			$result=curl_exec($curl_session);

			if($result){
				
				echo "sent ";
				return  true;
				
			}else{
				
				echo "failed";
				return  false;
			}

	}
}

?>