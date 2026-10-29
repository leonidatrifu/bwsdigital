# BrightSmile Dental: WordPress demo site

A demo website for a dental clinic, built as a **WordPress block theme** and a small **appointments plugin**. Everything you see can be edited in WordPress: page text, images, header, footer, menu, colours and fonts.

| Folder / file | What it is |
|---|---|
| `wp-content/themes/brightsmile/` | The theme: header, footer, page templates, 20 section patterns, colours and fonts |
| `wp-content/plugins/brightsmile-appointments/` | Booking form and contact form blocks, plus an "Appointments" inbox in the dashboard |
| `dist/*.zip` | The same theme and plugin, ready to upload to any WordPress site |
| `start.sh` + `blueprint.json` | Run the demo locally with WordPress Playground (needs only Node.js) |

## Run it locally

```bash
./start.sh
```

Then open http://127.0.0.1:9400. You're logged in as admin automatically. Your edits are saved between runs. Run `./start.sh --reset` to start over with fresh demo content.

## Install on a real WordPress site (6.6 or newer)

1. **Plugins → Add New → Upload** `dist/brightsmile-appointments.zip`, then activate it.
2. **Appearance → Themes → Add New → Upload** `dist/brightsmile-theme.zip`, then activate it.

When you activate the theme, it creates the Home, About Us, Services, Book an Appointment and Contact pages. It also sets Home as the front page, turns on pretty permalinks and builds the main menu. Pages that already exist with the same slug are never overwritten.

## What's on the site

- **Menu bar:** a top info bar (address, hours, phone), the logo, the main menu and a "Book Appointment" button. On phones it becomes a hamburger menu.
- **Footer:** about text, social icons, quick links, services, address and opening hours, and a copyright line.
- **Home:** hero, key numbers, six service cards, why choose us, "your first visit" steps, testimonials and a call-to-action.
- **About Us:** the clinic's story and mission, values, four team members and a call-to-action.
- **Services:** eight treatments, a price list, an FAQ and a call-to-action.
- **Book an Appointment:** a working booking form (treatment, date, time, new or returning patient, notes) with a sidebar.
- **Contact:** contact cards, a working message form and an OpenStreetMap map.

## How to edit

| To change… | Go to… |
|---|---|
| Page text and images | **Pages**, then open the page. Every section is made of normal blocks. |
| Header, footer and menu | **Appearance → Editor → Patterns → Header / Footer**, and **Appearance → Editor → Navigation** |
| Colours, fonts and buttons | **Appearance → Editor → Styles**. There's also an "Ocean Blue" colour variation. |
| Add a ready-made section | In the block inserter, open **Patterns → BrightSmile sections** |
| Start a new page from a layout | Create a page and pick a **BrightSmile pages** pattern |
| Booking form options | Select the *Appointment Form* block and use the sidebar: treatments, time slots, closed days, button text, notification email, patient confirmation email |
| Contact form options | Select the *Clinic Contact Form* block and use the sidebar |
| Bookings and messages | **Appointments** in the dashboard menu. Set a status (Pending, Confirmed, Completed or Cancelled), add phone bookings, and read contact messages. |

Extra block styles you can pick in the block sidebar: **Card** and **Rounded panel** (Group), **Eyebrow label** (Paragraph), **Checklist** (List) and **Soft corners** (Image).

## Notes

- The clinic name, address, phone numbers, team, reviews and prices are made up. Replace them before going live.
- The images are lightweight SVG illustrations. Swap in real photos with the image block's **Replace** button.
- Emails go through `wp_mail()`. On a real host, add an SMTP plugin so they get delivered. In local Playground, emails aren't sent, but every request is still saved under **Appointments**.
- The forms include a nonce, a hidden spam-trap field and server-side checks (valid email, no past dates or closed days, only allowed treatments and times).
