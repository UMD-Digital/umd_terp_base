# UMD Terp Paragraphs: Buttons/Links

Paragraphs integration of buttons and links for UMD projects. This module provides a way to add buttons to Kitchen Sink Pages.

This module contains markup only (no js or css), those should be provided in the UMD Terp Theme:

- [UMD Terp Theme](https://github.com/UMD-Digital/umd_terp)

## Configuration

Provides both the "Button Set" and "Button" paragraphs, as well as the the "Link Set" and "Link" paragraphs. Button set and Link Set are wrappers for the respective individual elements, and should always be added first.

The following fields are available on the Button Set KS widget:

- Center: Boolean

The following fields are available on the Button KS widget:

- Style: Primary, Secondary, Success, Danger, Warning, Info, Light, Dark, Link
- Link: URL, Text, and target.

The following fields are available on the Link Set KS widget:

- Center: Boolean

The following fields are available on the Link KS widget:

- Link: URL, Text, and target.

## Markup Overrides

- You may override paragraphs templates by copying them into the client theme.
- You may override hooks by copying into client .theme, and modifying hook name/etc.
