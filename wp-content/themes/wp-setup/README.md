
# Website Launch Checklist

Version: 1 (2.9.2020)

## WordPress

- [ ] Die WP-Version ist aktuell
- [ ] Nicht gebrauchte Themes wurde entfernt
- [ ] Ein Favicon ist im Customizer hinterlegt
- [ ] Die Angaben zum Theme in style.css sind angepasst
- [ ] Es sind sinnvolle Permalinks konfiguriert
- [ ] Alle Permalinks funktionieren
- [ ] Titel und Untertitel der Seite sind gesetzt
- [ ] Die korrekte Sprache, Zeitzone und Datums- und Zeitformat wurde definiert
- [ ] Die Startseite ist gesetzt

### Theme

- [ ] Der Viewport-Metatag für die responsive Darstellung ist gesetzt
- [ ] Eine Theme-Vorschau (_screenshot.png, 1200 x 900_) ist vorhanden
- [ ] Eine 404-Seite mit sinnvollem Inhalt ist vorhanden (_404.php_)

### Konfiguration

- [ ] Es befinden sich keine unnötigen Meta Tags im _head_
- [ ] Nicht benötigte Funktionen sind deaktiviert (z.B. Kommentare, Emojis)
- [ ] Nicht benötigte Requests/Libs sind deaktiviert
- [ ] Die Seite ist nicht für SE-Bots blockiert

### Plugins

Standard
- [ ] Advanced Custom Fields PRO
- [ ] ACF Duplicate Repeater
- [ ] ACF Hide Layout
- [ ] Admin Menu Editor
- [ ] Clean Image Filenames
- [ ] Duplicate Post Page Menu & Custom Post Type
- [ ] LiteSpeed Cache
- [ ] Members
- [ ] Really Simple SSL
- [ ] 	Safe SVG
- [ ] Simple Custom Post Order
- [ ] Simplistic SEO

Optional
- [ ] 	Ninja Forms
- [ ] Polylang
- [ ] Polylang Theme Strings
- [ ] WP Mail Logging

## CSS

- [ ] styles.min.css, blocks.min.css und admin.min.css sind eingebunden
- [ ] Die Schriftgrösse skalieren im korrekten Verhältnis
- [ ] Allfällige overrides im Block-Editor sind in adminBlocks.scss (z.B. img -> inline-block)

Das Design wurde auf folgende Breakpoints optimiert:
- [ ] 1800px
- [ ] 1366px
- [ ] 1024px
- [ ] 768px
- [ ] 375px

## Markup
- [ ] Das \<img> _sizes_ Attribut ist befüllt
- [ ] Das \<img> _loading="lazy"_ Attribut ist gesetzt
- [ ] Die \<img> Attribute src, srcset, alt und title sind befüllt
- [ ] Falls \<a> _target="\_blank"_ dann _rel="noopener"_
- [ ] Es sind \<header>, \<main> und \<footer> gesetzt
- [ ] Die Analytics-ID ist gesetzt

## JavaScript

- [ ] Die Konsole schmeisst keine Fehler
- [ ] Komponenten sind nach Möglichkeit in einzelne Files ausgelagert

## Performance

- [ ] Alle Bilder sind in sinnvollen Formaten und Dimensionen eingebunden
- [ ] Alle Bilder sind komprimiert (Imageoptim)
- [ ] Der LiteSpeed-Cache ist aktiviert

## Accessibility

- [ ] Alle Links enthalten einen aussagekräftigen Text (für visuelle Links versteckten Text definieren)
- [ ] Wichtige Informationen werden nicht nur durch Farbe vermittelt (vorallem Links)
- [ ] Allfällige Formulare sind barrierefrei (Labels, Pflichtfelder, Feedback bei Fehlern, ARIA-Labels)
- [ ] Allfällige Tabellen sind barrierefrei (_th_-Elemente mit _scope_-Attribut, _caption_-Element)

## SEO

- [ ] Die Website ist in der Google Search Console registriert
- [ ] Sinnvolle _title_-Tags und _meta-description_-Attribute sind vorhanden

## Browser- und Gerätekompatibilität

Die Website funktioniert in allen gängigen Browsern

- [ ] Chrome
- [ ] Firefox
- [ ] Safari
- [ ] Edge
- [ ] Internet Explorer 11

## Validatoren & Speedtests

- [ ] [W3C Validator](https://validator.w3.org/)
- [ ] [Pingdom Speed Test](https://tools.pingdom.com/)
- [ ] Google Lighthouse

## Sicherheit

- [ ] Alle Benutzer benutzen sichere Passwörter
- [ ] Ein SSL-Zertifikat ist aktiviert
- [ ] Es wird automatisch auf https weitergeleitet

## Go Live

### Allgemein
- [ ] Allfällige Formulare funktionieren einwandfrei und werden an die korrekte Empfänger-Adresse gesendet

### Hosting
- [ ] Der Kunde ist als Halter und Rechungskontakt des Hostings und der Domains eingetragen
- [ ] Allfällige DNS-Einträge sind konfiguriert
- [ ] Allfällige E-Mail-Konten sind eingerichtet
- [ ] Allfällige Staging-Instanzen sind entfernt
- [ ] Die _htaccess_-Datei ist korrekt konfiguriert
