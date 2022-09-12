const isGui = typeof document !== 'undefined'

async function getFile (file) {
  if (isGui) {
    return await fetch(file)
  } else {
    const text = require('fs').readFileSync(file, 'utf-8')
    return { ok: true, text: () => text, json: () => JSON.parse(text) }
  }
}

async function search (query) {
  if (!query) return null
  query = query.toLowerCase()
  const scriptResp = await getFile('script.txt')
  const songResp = await getFile('songs.json')
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

if (isGui) {
  document.addEventListener('DOMContentLoaded', event => {
    document.getElementById('q').focus()
    const q = new URLSearchParams(document.location.search).get('q')
    if (q) {
      addResult(q)
    }
  })
} else {
  const q = process.argv[2]
  search(q).then(console.dir)
}
