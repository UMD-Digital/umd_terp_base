# About UMD Terp Base Module

UMD Terp Base is the base module for all UMD drupal 8 projects. It is designed to be installed along with the [UMD Terp Theme](https://github.com/UMD-Digital/umd_terp). This module provides a suite of modules, functions, and configuration to make that theme work as designed.

- [UMD Terp Theme](https://github.com/UMD-Digital/umd_terp)
- [UMD Terp Base Module](https://github.com/UMD-Digital/umd_terp_base)

## Installation

Install as you normally would any drupal 8 module.

### Via Composer:

- `composer require umd_digital/umd_terp_base --prefer-dist`
- `drush en umd_terp_base` or enable via admin UI
- Enable all desired sub modules

### Manually

- Download this repo into /modules/contrib/umd_terp_base
- `drush en umd_terp_base` or enable via admin UI
- Enable all desired sub modules

## Configuration

- No configuration needed.

### Sub Modules

- umd_terp_content_types: Provides various customizations and configurations for content types used in the "UMD Terp" theme.
- ut_accordion: Paragraphs integration of accordions for UMD projects. This module provides a way to add an accordion to Kitchen Sink Pages.
- ut_blockquote: Paragraphs integration of blockquote for UMD projects. This module provides a way to add a blockquote to Kitchen Sink Pages.
- ut_button: Paragraphs integration of buttons and links for UMD projects. This module provides a way to add buttons to Kitchen Sink Pages.
- ut_card: Paragraphs integration of cards for UMD projects. This module provides a way to add a cards to Kitchen Sink Pages.
- ut_carousel: Paragraphs integration of a carousel for UMD projects. This module provides a way to add a carousel to Kitchen Sink Pages.
- ut_divider: Paragraphs integration of a Horizontal Rule for UMD projects. This module provides a way to add a Horizontal Rule to Kitchen Sink Pages.
- ut_events: Paragraphs integration of an Events Feed (from calendar.umd.edu) for UMD projects. Essentially, this module pulls a feed of upcoming events from hub.umd.edu, with optional filter paramaters available, in order to highlight relevant events.
- ut_feature: Paragraphs integration of features for UMD projects. This module provides a way to add a feature to Kitchen Sink Pages.
- ut_images: Paragraphs integration of images for UMD projects. This module provides a way to add a images to Kitchen Sink Pages.
- ut_news: Paragraphs integration of a News Feed (from calendar.umd.edu) for UMD projects. Essentially, this module pulls a feed of articles from hub.umd.edu, with optional filter paramaters available, in order to highlight relevant articles.
- ut_people: Paragraphs integration of people for UMD projects. This module provides a way to add a list of Content Type People to Kitchen Sink Pages.
- ut_sidebar_menu: This module provides a customized sidebar menu, for use in the UMD Terp theme.
- ut_slideshow: Paragraphs integration of a slideshow for UMD projects. This module provides a way to add a slideshow to Kitchen Sink Pages.
- ut_stats: Paragraphs integration of statistics for UMD projects. This module provides a way to add statistics to Kitchen Sink Pages.
- ut_table: Paragraphs integration of a tablefield for UMD projects. This module provides a way to add a a table to Kitchen Sink Pages.
- ut_tabs: Paragraphs integration of tabs for UMD projects. This module provides a way to add an tabs to Kitchen Sink Pages.
- ut_text: Paragraphs integration of HTML/Text widgets for UMD projects. This module provides a way to add HTML/Text to Kitchen Sink Pages.
- ut_video: Paragraphs integration of a video for UMD projects. This module provides a way to add a a video to Kitchen Sink Pages.
- ut_view: Paragraphs integration of a view for UMD projects. This module provides a way to add a view to Kitchen Sink Pages.
- ut_webform: Paragraphs integration of a webform for UMD projects. This module provides a way to add a webform to Kitchen Sink Pages.

## Development

### Versioning

Semantic tagging must take place in github for the updates to be able to be pulled via composer. When ready to deploy, create a tag in github up one version from previous, with the starting version being 8.1.0:

- Minor versions (non breaking changes): 8.1.1, 8.1.2, etc.
- Major versions (breaking changes): 8.2.0, 8.3.0, etc.

### Core (base) module issues, patches, etc

All edits, requests, etc should be submitted to the github repo for the [UMD Terp Base Module](https://github.com/UMD-Digital/umd_terp_base). Please add issues to the [issues queue](https://github.com/UMD-Digital/umd_terp_base/issues). Patches will be reviewed on a merit and resources available basis.

### Frontend

All CSS, JS, etc are based in the [UMD Terp Theme](https://github.com/UMD-Digital/umd_terp). This module contains no frontend styles for any widgets/etc.

### Customization

- THIS MODULE SHOULD NEVER BE MODIFIED DIRECTLY.
- All customizations should go into a custom module.

All Configuration for each module is created on install. Technically, you can modify these, though we do not reccomend it. Any future updates for modules will come with a hook to re-install config for that module, so better to leave any existing module config as is. Changes to existing configuration are better done via form_alter hooks, leaving default config in place.

#### Nodes

Use `hook_form_alter()`. For example, to remove the "Hide sidebar" boolean from themes that do not need it, in YOUR_CUSTOM_MODULE do the following:

```php
function YOUR_CUSTOM_MODULE_form_alter(&$form, FormStateInterface $form_state, $form_id) {
  // Hide the sidebar boolean.
  if ($form_id == 'node_umd_terp_basic_page_form' || $form_id = 'node_umd_terp_basic_page_edit_form') {
    if ( isset($form['field_umdt_ct_hide_sidebar'])) {
      $form['field_umdt_ct_hide_sidebar']['#access'] = FALSE;
    }
  }
}
```

#### Paragraphs

Use `hook_field_WIDGET_TYPE_paragraphs_form_alter()`. For example, to remove the "style (light or dark) from a theme that does not need/want it, in YOUR_CUSTOM_MODULE do the following:

```php
function YOUR_CUSTOM_MODULE_field_widget_paragraphs_form_alter(&$element, &$form_state, $context) {
  // Remove light/dark choice from UT Blockquote.
  if ($element['#paragraph_type'] == 'ut_blockquote') {
    if (isset($element['subform']['field_ut_blockquote_style'])) {
      $element['subform']['field_ut_blockquote_style']['#access'] = FALSE;
    }
  }
}
```

#### Markup/Hook Overrides

- You may override paragraphs templates by copying them into the sub-theme theme folder.
- You may override hooks by copying into sub-theme .theme, or custom module .module and modifying hook name/etc.
