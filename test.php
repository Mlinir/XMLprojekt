<users>
    <user>
        <username></username>
        <password></password>
        <notes>
            <note>
                <date></date>
                <content></content>
            </note>
        </notes>
    </user>
</users>

$note=$notes->addChild('note');
            $note->addChild('date');
            $note->addChild('content');

            onclick="onDelete(' . $count . ')"


            echo '<input name="delete" type="submit" value="Briši" onclick="onDelete(' . $count . ')"/><br/>';
            echo '<button class="btn btn-sm btn-danger onclick="onDelete(' . $count . ')"/>Izbriši</button><br/>';
            echo '<button class="btn btn-sm btn-danger type="submit" value="' . $count . '" id="delete"/>Izbriši</button><br/>';


            <?php
session_start();
if (isset($_POST['delete'])) {
    $number = $_POST['delete'];
    $xml = simplexml_load_file('users.xml');
    foreach ($xml->user as $user) {
        if ($user->username == $_SESSION['username']) {
            foreach ($user->notes as $notes) {
                if ($notes->note['id'] == $number) {
                    echo "somthin";
                    unset($notes->note);
                }
            }
            $xml->asXML('users.xml');
            echo "Bilješka uspješno obrisana";
        }
    }
}

?>
