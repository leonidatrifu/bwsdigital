# Clearcoat Detailing: WordPress demo site

A minimal one-page website for an auto detailing business, built as a **classic WordPress theme**. The front page has a hero, three service packages with prices, a four-step process and booking details.

| Folder / file | What it is |
|---|---|
| `wp-content/themes/clearcoat/` | The theme: header, footer, front page and a fallback template for other pages and posts |
| `dist/clearcoat-theme.zip` | The same theme, ready to upload to any WordPress site |
| `static/clearcoat.html` | A plain HTML version of the front page, for previewing without WordPress |

## Install on a WordPress site (6.0 or newer)

1. **Appearance → Themes → Add New → Upload Theme**, choose `dist/clearcoat-theme.zip`, then activate it.
2. **Settings → Reading**: choose **A static page** and pick a page as the Homepage. Without this, the homepage shows your latest posts.
3. **Appearance → Customize → Business details**: set the tagline, phone, email and hours.
4. Optional: **Appearance → Menus**, create a menu and assign it to **Top menu**. Until then the top links are Services, Process and Book.

## How to edit

| To change… | Go to… |
|---|---|
| Business name in the top bar and footer | **Settings → General → Site Title** |
| Tagline, phone, email, hours | **Appearance → Customize → Business details** |
| Extra text above the booking section | Edit the page set as the Homepage |
| Headline, services, prices, process steps, key numbers | `wp-content/themes/clearcoat/front-page.php` |
| Colours and fonts | The `:root` block at the top of `wp-content/themes/clearcoat/style.css` |

The site follows the visitor's light or dark mode setting automatically.
