<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Output Vite asset tags for a given entry point.
 *
 * In development: connects to Vite dev server (HMR).
 * In production: reads manifest.json for hashed filenames.
 *
 * @param string $entry Entry point name (e.g., 'src/backend.js')
 * @return string HTML script/link tags
 */
function vite_assets(string $entry): string
{
    $dev_server = 'http://localhost:5173';
    $manifest_path = FCPATH . 'assets/build/.vite/manifest.json';

    // Development mode: use Vite dev server
    if (config('debug'))
    {
        $context = stream_context_create(['http' => ['timeout' => 1]]);
        $check = @file_get_contents($dev_server . '/@vite/client', false, $context);

        if ($check !== false)
        {
            return '<script type="module" src="' . $dev_server . '/@vite/client"></script>' . PHP_EOL
                 . '<script type="module" src="' . $dev_server . '/' . $entry . '"></script>' . PHP_EOL;
        }
    }

    // Production mode: read manifest
    if ( ! file_exists($manifest_path))
    {
        return '<!-- Vite manifest not found. Run: npm run build -->';
    }

    $manifest = json_decode(file_get_contents($manifest_path), true);

    if ( ! isset($manifest[$entry]))
    {
        return '<!-- Vite entry not found: ' . htmlspecialchars($entry) . ' -->';
    }

    $asset = $manifest[$entry];
    $base_url = base_url('assets/build/');
    $html = '';

    if ( ! empty($asset['css']))
    {
        foreach ($asset['css'] as $css_file)
        {
            $html .= '<link rel="stylesheet" href="' . $base_url . $css_file . '">' . PHP_EOL;
        }
    }

    if ( ! empty($asset['file']))
    {
        $html .= '<script type="module" src="' . $base_url . $asset['file'] . '"></script>' . PHP_EOL;
    }

    return $html;
}
