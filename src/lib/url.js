import { vars } from './vars.js'

export function siteUrl(uri = '') {
    const baseUrl = vars('base_url') || '/'
    return baseUrl.replace(/\/$/, '') + '/' + uri.replace(/^\//, '')
}
