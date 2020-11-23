# UMD Terp Paragraphs: Stats

Paragraphs integration of statistics for UMD projects. This module provides a way to add statistics to Kitchen Sink Pages.

This module contains markup only (no js or css), those should be provided in the UMD Terp Theme:

- [UMD Terp Theme](https://github.com/UMD-Digital/umd_terp)

## Configuration

Provides the "Stat Group" and "Stats" paragraphs.

The following fields are available on the Stats Group KS widget:

- Style: Light or Dark

The following fields are available on the Stat KS widget:

- Value: The number value
- Text: Accompaning text for the stat
- Image: You may optionally add an image/icon to go with these stats. If used, be sure to use images of the same sizes for all stats, preferably in the form of a transparent .png.

## Markup Overrides

- You may override paragraphs templates by copying them into the client theme.
- You may override hooks by copying into client .theme, and modifying hook name/etc.
