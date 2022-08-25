/* global ytMap, nameMap */
async function search (query) {
  if (!query) return null
  query = query.toLowerCase()
  const resp = await fetch('script.u')
  if (!resp.ok) return null
  const contents = await resp.text()
  const matches = contents.toLowerCase().split(/bgm1v?|bgmplay2?/m)
  for (const match of matches) {
    if (match.includes(query)) {
      const thing = match.split(/\n|,/m)[0].trim()
      const title = nameMap[thing]
      const yt = ytMap[thing]
      const filename = contents.match(new RegExp(`BGM_s_Ch = ${thing}\\s+mov.+"(.+)"`))[1].replace(/\\/g, '/')
      if (title && filename && yt) {
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
  const q = new URLSearchParams(document.location.search).get('q')
  if (q) {
    addResult(q)
  }
})
