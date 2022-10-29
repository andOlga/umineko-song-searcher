async function search (query) {
  if (!query) return null
  query = query.toLowerCase()
  const scriptResp = await fetch('script.txt')
  const songResp = await fetch('songs.json')
  if (!scriptResp.ok || !songResp.ok) return null
  const contents = await scriptResp.text()
  const songs = await songResp.json()
  const matches = contents.toLowerCase().split(/bgm1v?|bgmplay2?/m)
  for (const match of matches) {
    if (match.includes(query)) {
      const songId = match.split(/\n|,/m)[0].trim()
      const title = songs[songId]?.name
      const yt = songs[songId]?.yt
      let filename = contents.match(new RegExp(`BGM_s_Ch = ${songId}\\s+mov.+"(.+)"`))
      if (title && filename && yt) {
        filename = filename[1].replace(/\\/g, '/')
        return { title, filename, yt }
      } else {
        return null
      }
    }
  }
}

async function addResult (q) {
  document.getElementById('result').style.display = 'block'
  const rt = document.getElementById('resultText')
  const yt = document.getElementById('yt')
  rt.innerText = 'Downloading game script, please wait...'
  const data = await search(q)
  if (data) {
    rt.innerText = `Search result: ${data.title} (${data.filename})`
    yt.src = `https://www.youtube-nocookie.com/embed/${data.yt}`
  } else {
    rt.innerText = 'Nothing found.'
    yt.src = 'https://www.youtube-nocookie.com/embed/bnH9Gbw4ybk'
  }
}

document.addEventListener('DOMContentLoaded', event => {
  if (window.location.protocol === 'file:') {
    document.write('Please do not open index.html directly in a browser, as browser security policies won\'t allow the app to run correctly. Instead, please open a terminal in the folder and run <pre>python -m http.server</pre>, and navigate to the URL shown.')
    return
  }
  document.getElementById('q').focus()
  const q = new URLSearchParams(document.location.search).get('q')
  if (q) {
    addResult(q)
  }
})
