<?php
if (empty($_SERVER['HTTPS'])) {
  header('Location: https://umineko-song-searcher.herokuapp.com');
  die;
}
?>
<style>
  body {
    color: gray;
    background-color: #3d1600;
    max-width: 640px;
    margin-left: auto;
    margin-right: auto;
  }

  #findstr {
    width: 100%;
    display: block;
  }

  #submit {
    margin-left: 43.5%;
  }

  #result {
    color: red;
    margin-top: 10px;
    margin-bottom: 10px;
  }
  #title {
    margin-left: 41%;
    margin-bottom: 20px;
  }

  #rules a, #rules a:visited {
    color: gray;
  }

  #result a, #result a:visited {
    color: red;
  }
</style>
<title>Umineko Song Searcher</title>
<img src='/logo.png' width='640'>
<div id='title'>Song Searcher</div>
<script>
  document.addEventListener('DOMContentLoaded', event => {
    document.getElementById('submit').addEventListener('click', event => {
      let fd = new FormData()
      let result = document.getElementById('result')
      result.innerText = 'Searching...'
      fd.append('findstr', document.getElementById('findstr').value)
      fd.append('fancy', 'yes')
      fetch('/search.php', {
        method: 'POST',
        body: fd
      }).then(response => response.json().then(data => {
        result.innerHTML = `Search result: <a href="https://youtu.be/${data.yt}" target=_blank>${data.title}</a> (${data.bgm})`
      }))
    })
  })
</script>
<div>
  <input type='text' id='findstr'>
  <button id='submit' type='button'>Search</button>
</div>
<div id='result'></div>
<div id='rules'>
  Type some text from <nobr>Umineko no Naku Koro ni</nobr> to figure out the song that plays at this moment. Notes:
  <ul>
    <li>This works only with the official translation that is published by Mangagamer, with or without the <nobr>07th-Mod</nobr> patch.
      This won't work if you're using the old <nobr>Witch Hunt</nobr> translation patch, UmiTweak, or <nobr>Umineko Project</nobr>
      due to translation differences.</li>
    <li>Fragments of text that are too long may not work due to formatting commands appearing in the middle.</li>
    <li>Fragments of text that are too short may end up with the wrong song result because they are not unique.</li>
    <li>If the song that is found doesn't seem correct, try searching for a longer Fragment of text or just scroll forward/backward a bit in the game and try a different Fragment.</li>
    <li>
      Generally, a Fragment of text corresponding to a single voice clip in <nobr>07th-Mod</nobr> should work. It may or may not be a complete sentence.
    </li>
    <li>
      Sequences of about 5 words, give or take, tend to work correctly.
    </li>
    <li>
      If you would like to extract the music files from the game with sensible filenames, please check out the <a href="https://github.com/ooa113y/umineko-song-searcher/tree/master/extraction">extraction scripts</a>.
    </li>
  </ul>
  <div style='margin-bottom: 5px'>The source code for this app is <a href="https://github.com/ooa113y/umineko-song-searcher">available</a>.</div>
</div>
