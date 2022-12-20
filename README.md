<!-- SHIELDS -->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![License][license-shield]][license-url]

<p>
  <a href="https://github.com/helsingborg-stad/prepend-subdomain">
    <img src="docs/images/hbg-github-logo-combo.png" alt="Logo" width="300">
  </a>
</p>
<h3>Prepend Subdomain</h3>
<p>
  <br />
  <a href="https://github.com/helsingborg-stad/prepend-subdomain/issues">Report Bug</a>
  ·
  <a href="https://github.com/helsingborg-stad/prepend-subdomain/issues">Request Feature</a>
</p>

## Summary
**Warning!**  
The usage of this plugin is higly destructive to your database content by design!  
This should not be used on a production environment.

The plugin adds WP CLI command for prepending of subdomains in nessessary tables.  
Filters different WP content output and adds a defined subdomain to all content in realtime.  
Example usage would be for staging/test environment where we don´t want to do an entire search and replace in a large database.  
For quick cloning of production environments.

## Config
Sub domain in real time replacement is defaulted to `stage`.  
You can override it with `PREPEND_SUBDOMAIN` constant. 
```php
define('PREPEND_SUBDOMAIN', 'alternative')
```
would replace in realtime `example.com` -> `alternative.example.com`

## Example workflow
Clone your environment with code files, media and database.  
Using wp cli activate the plugin.  
```bash
wp plugin activate prepend-subdomain
```
To replace the nessessary database values and prepend your subdomain. ie. `example.com` -> `stage.example.com`
```bash
wp prepend stage
```
The plugin itself with replace any existing domains `https://example.com` -> `https://stage.example.com` in realtime.


## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request



## License

Distributed under the [MIT License][license-url].


<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/helsingborg-stad/prepend-subdomain.svg?style=flat-square
[contributors-url]: https://github.com/helsingborg-stad/prepend-subdomain/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/helsingborg-stad/prepend-subdomain.svg?style=flat-square
[forks-url]: https://github.com/helsingborg-stad/prepend-subdomain/network/members
[stars-shield]: https://img.shields.io/github/stars/helsingborg-stad/prepend-subdomain.svg?style=flat-square
[stars-url]: https://github.com/helsingborg-stad/prepend-subdomain/stargazers
[issues-shield]: https://img.shields.io/github/issues/helsingborg-stad/prepend-subdomain.svg?style=flat-square
[issues-url]: https://github.com/helsingborg-stad/prepend-subdomain/issues
[license-shield]: https://img.shields.io/github/license/helsingborg-stad/prepend-subdomain.svg?style=flat-square
[license-url]: https://raw.githubusercontent.com/helsingborg-stad/prepend-subdomain/main/LICENSE
