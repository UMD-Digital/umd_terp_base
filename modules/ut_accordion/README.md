# UMD Terp Paragraphs: Accordions

Paragraphs integration of accordions for UMD projects. This module provides a way to add an accordion to Kitchen Sink Pages.

This module contains markup only (no js or css), those should be provided in the UMD Terp Theme:

- [UMD Terp Theme](https://github.com/UMD-Digital/umd_terp)

## Configuration

Provides the "Accordion" and "Accordion Item" paragraphs.

The following fields are available on the Accordion KS widget:

- Open First: Defines if the first accordion item should be open by default.
- Open Multiple: Defines if multiple accordions can be open at once.

The following fields are available on the Accordion Item KS widget:

- Title: Defines if the first accordion item should be open by default.
- Content: Paragraphs field that allows one to add Text, Blockquote, Divider, Button, Table, Webform or View.

## Markup Overrides

- You may override paragraphs templates by copying them into the client theme.
- You may override hooks by copying into client .theme, and modifying hook name/etc.
