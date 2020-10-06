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

  a, a:visited {
    color: gray;
  }
</style>
<img src='/logo.png' width='640'>
<div id='title'>Song Searcher</div>
<script>
  let firstSearch = true
  document.addEventListener('DOMContentLoaded', event => {
    document.getElementById('submit').addEventListener('click', event => {
      let fd = new FormData()
      let result = document.getElementById('result')
      result.innerText = firstSearch ? 'Downloading newest script files...' : 'Searching...'
      fd.append('findstr', document.getElementById('findstr').value)
      fetch('/search.php', {
        method: 'POST',
        body: fd
      }).then(response => response.text().then(t => {
        result.innerText = `Search result: ${t}`
        firstSearch = false
      }))
    })
  })
</script>
<div>
  <input type='text' id='findstr'>
  <button id='submit' type='button'>Search</button>
</div>
<div id='result'></div>
<div>
  Type some text from Umineko no Naku Koro ni to figure out the song that plays at this moment. Notes:
  <ul>
    <li>This works only with the official translation that is published by Mangagamer, with or without the 07th Mod patch.
      This won't work if you're using the old Witch Hunt translation patch, UmiTweak, or Umineko Project
      due to translation differences.</li>
    <li>Fragments of text that are too long may not work due to formatting commands appearing in the middle.</li>
    <li>Fragments of text that are too short may end up with the wrong song result because they are not unique.</li>
    <li>If the song that is found doesn't seem correct, try searching for a longer Fragment of text or just scroll forward/backward a bit in the game and try a different Fragment.</li>
    <li>
      Generally, a Fragment of text corresponding to a single voice clip in 07th Mod should work. It may or may not be a complete sentence.
    </li>
    <li>
      Sequences of about 5 words, give or take, tend to work correctly.
    </li>
    <li>
      If the search form doesn't work at all, not even producing empty results, your browser may be out of date.
      <a href="https://updatemybrowser.org/">Update it</a> or use the <a href='/oldindex.php'>non-fancy search form</a>.
    </li>
  </ul><br>
  The source code for this app is <a href="https://github.com/ooa113y/umineko-song-searcher">available</a>, but awful.<br>
  If you are interested in a full English port of the PS3 version of Umineko to PC, which includes built-in song title display, lip sync, and various beautiful visual effects that cannot be found in other versions, I recommend to check out <a href='https://umineko-project.org'>Umineko Project</a> and <a href='https://github.com/ooa113y/umiproj-wh-tl'>my port of the official translation</a> to that engine.
</div>
