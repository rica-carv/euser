# euser Enhanced User plugin (or addon) for E107. Part of the E series plugins (or addons)

**eUser** is an advanced plugin for the e107 CMS, enhancing user data management and display with a focus on modern themes and Bootstrap compatibility.

---

## Key Features

- Custom administration interface for users and extended fields.
- Bootstrap-friendly tabs for extended fields with support for:
  - `tabs` → Full e107 tab rendering (default)
  - `tabs_caption` → Only the tab navigation items
  - `tabs_text` → Only the tab content panes
- Advanced shortcodes for front-end and back-end templates.
- Dynamic menus: dashboard, friends, latest comments.
- Optional integration with external modules (Coppermine, FlashChat, Gallery2, SMF, etc.).
- Customizable templates for fields and tabs.
- Fixes session and caching issues for `user_extended` values.
- Supports PHP 8.x and modern e107 coding standards.
- Designed for Bootstrap-based themes, adaptable to other modern themes.

---

## Plugin Structure

- `admin_*.php` – Administration of modules, fields, and templates.
- `euser_class.php` – Core plugin logic.
- `shortcodes/batch/` – Shortcodes for templates and front-end rendering.
- `templates/` – Customizable templates for tabs and fields.
- `js/` and `css/` – Front-end scripts and styles.
- `euser_dashboard_menu.php` – Dashboard menus and widgets.
- `euser_friends_menu.php` – Friends menu.
- `euser_lastcomments_menu.php` – Latest comments menu.
- `README.md` – Full documentation.

---

## Installation

1. Copy the `euser` folder into `e107_plugins/` in your e107 installation.
2. Install or update via the e107 admin interface.
3. Configure templates and shortcodes as needed.

---

## Main Shortcodes

### `{USEREXTENDED_ALL}`

Renders the user’s extended fields.  

**Available parameters:**

| Parameter       | Description |
|-----------------|------------|
| `tabs`           | Renders full tabs (default e107 style) |
| `tabs_caption`   | Renders only the tab navigation items (for custom templates) |
| `tabs_text`      | Renders only the tab content panes |

**Example usage in a Bootstrap-based theme:**

```html
<ul class="nav nav-tabs">
  {USEREXTENDED_ALL=tabs_caption}
</ul>

<div class="tab-content">
  {USEREXTENDED_ALL=tabs_text}
</div>
```

**Example usage in a standard template:**

```html
<div class="user-extended-wrapper">
  {USEREXTENDED_ALL}
</div>
```

---

### Menus & Widgets Shortcodes

| Shortcode                     | Description |
|--------------------------------|------------|
| `{EUSER_DASHBOARD_MENU}`       | Displays the user dashboard menu. |
| `{EUSER_FRIENDS_MENU}`         | Displays the friends menu. |
| `{EUSER_LASTCOMMENTS_MENU}`    | Displays the user’s latest comments. |

**Example usage for tabs with menus:**

```html
<ul class="nav nav-tabs">
  <li class="nav-item active">
    <a class="nav-link active" href="#base_tab" data-bs-toggle="tab" role="tab">Base Settings</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#dashboard_tab" data-bs-toggle="tab" role="tab">Dashboard</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#friends_tab" data-bs-toggle="tab" role="tab">Friends</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#comments_tab" data-bs-toggle="tab" role="tab">Latest Comments</a>
  </li>
</ul>

<div class="tab-content">
  <div class="tab-pane fade show active" id="base_tab" role="tabpanel">
    {USEREXTENDED_ALL=tabs_text}
  </div>
  <div class="tab-pane fade" id="dashboard_tab" role="tabpanel">
    {EUSER_DASHBOARD_MENU}
  </div>
  <div class="tab-pane fade" id="friends_tab" role="tabpanel">
    {EUSER_FRIENDS_MENU}
  </div>
  <div class="tab-pane fade" id="comments_tab" role="tabpanel">
    {EUSER_LASTCOMMENTS_MENU}
  </div>
</div>
```

---

## Templates

The plugin supports customizable templates for extended fields and categories.  
Templates allow full control of tab layout, cards, and menu appearance, keeping compatibility with Bootstrap or other CSS frameworks.

**Example: Custom field template snippet**

```html
<div class="extended-field">
  <label>{FIELDNAME}</label>
  <div class="field-input">{FIELDVAL}</div>
</div>
```

**Example: Full tab structure using custom templates**

```html
<div class="tabbed-menu">
  <ul class="nav nav-tabs">
    {USEREXTENDED_ALL=tabs_caption}
  </ul>
  <div class="tab-content">
    {USEREXTENDED_ALL=tabs_text}
  </div>
</div>
```

---

## Contribution

- This plugin is in beta development but fully functional.  
- Pull requests are welcome, especially for theme compatibility and module integrations.

---

## Disclaimer

Use this plugin at your own risk. The author is not responsible for any data loss or damage.
