import { siteUrl } from './url.js'

export function request(method, url, data) {
    return fetch(siteUrl(url), {
        method,
        mode: 'cors',
        credentials: 'same-origin',
        headers: { 'Content-Type': 'application/json' },
        redirect: 'follow',
        body: data ? JSON.stringify(data) : undefined,
    }).then(async (response) => {
        if (!response.ok) {
            const message = await response.text()
            const error = new Error(message)
            error.status = response.status
            throw error
        }
        return response.json()
    })
}

export function upload(method, url, file) {
    const formData = new FormData()
    formData.append('file', file, file.name)
    return fetch(siteUrl(url), {
        method,
        redirect: 'follow',
        body: formData,
    }).then(async (response) => {
        if (!response.ok) {
            const message = await response.text()
            const error = new Error(message)
            error.status = response.status
            throw error
        }
        return response.json()
    })
}

export function download(method, url) {
    return fetch(siteUrl(url), {
        method,
        mode: 'cors',
        credentials: 'same-origin',
        headers: { 'Content-Type': 'application/json' },
        redirect: 'follow',
    }).then(async (response) => {
        if (!response.ok) {
            const message = await response.text()
            const error = new Error(message)
            error.status = response.status
            throw error
        }
        return response.arrayBuffer()
    })
}
