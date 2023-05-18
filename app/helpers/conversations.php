<?php

function getConversations($user_id, $conn) {

    # Getting all the conversations for current (logged in) user
    $sql = "SELECT * FROM conversations
            WHERE user_1=? OR user_2=?
            ORDER BY conversation_id DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id, $user_id]);
    if($stmt->rowCount() > 0){
        $conversations = $stmt->fetchAll();
        # Create empty array to store the user conversation
        $user_data = [];

        # Looping through the conversation
        foreach ($conversations as $conversation) {
            
            if($conversation['user_1'] == $user_id){
                $sql2 = "SELECT name, username, p_p, last_seen
                         FROM users WHERE user_id=?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute([$conversation['user_2']]);
            }else{
                $sql2 = "SELECT name, username, p_p, last_seen
                         FROM users WHERE user_id=?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute([$conversation['user_1']]);
            }

            $allConversationns = $stmt2->fetchAll();

            # Pushing the data into the array
            array_push($user_data, $allConversationns[0]);

            return $user_data;
        }
    }else {
        $conversations = [];
        return $conversations;
    }
}
