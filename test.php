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