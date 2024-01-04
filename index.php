<html>
  <head>
    <title>Secret Chat</title>
    <link rel="stylesheet" href="secret-chat.css">
    <link rel="shortcut icon href="secret-chat-favicon.ico">
  </head>
  <body>
    <div id="secret-chat">
      <div id="left">
        <div class="information">
          <h2>Directions</h2>
          <ul>
            <li>Type into the boxes and post your message to the <i>Secret Chat</i></li>
            <li>Have fun</li>
          </ul>
        </div>
        <div class="information">
          <h2>Rules</h2>
          <ul>
            <li>No biting</li>
            <li>No bad stuff. Bad stuff will be removed</li>
            <li>Have fun</li>
          </ul>
        </div>
      </div>

      <div id="main">
        <section id="header">
          <h1 id="title">Secret Chat</h1>
        </section>

        <form method="get" onsubmit="displayMessages()">
          Name:
          <br>
          <input autocomplete="off" name="name" type="text">
          <br>
          Message:
          <br>
          <textarea autocomplete="off" name="message" type="text"></textarea>
          <br>
          <input type="submit" value="post">
        </form>

        <section id="message-display">
        </section>

      </div>

      <div id="right">
        <div class="information">
          <h2>Updates</h2>
          <ul>
            <li>Messages will now appear without needing to refresh the page!</li>
          </ul>
        </div>
        <div class="information">
          <h2>Current Members</h2>
          <ul>
            <li>Me.</li>
          </ul>
        </div>
      </div>
    </div>

    <?php
      $add_to_messages = "<div class=\"post\"><p class=\"name\">{$_GET['name']}<p><p class=\"message\">{$_GET['message']}<p></div>" . "\n" . "<!-- {$_GET['name']}: {$_GET['message']} -->" . "\n\n";

      if ($_GET['name'] && $_GET['message']) {
        $messages = file_get_contents("messages/messages.txt");
        
        file_put_contents("messages/messages.txt", 
        $add_to_messages . $messages);
        file_put_contents("messages/messages-backup.txt", $add_to_messages . $messages);
      }
    ?>

    <script>
      fetch('messages/messages.txt')
      .then(response => response.text())
      .then(text => {
        document.getElementById('message-display').innerHTML = text;
      });

      function displayMessages() {
        fetch('messages/messages.txt')
        .then(response => response.text())
        .then(text => {
          document.getElementById('message-display').innerHTML = text;
        });
      }

      setInterval(displayMessages, 1000);
    </script>
  </body>
</html>
