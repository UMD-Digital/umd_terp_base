# UMD Terp Paragraphs: Stats

Paragraphs integration of statistics for UMD projects. This module provides a way to add statistics to Kitchen Sink Pages.

This module contains markup only (no js or css), those should be provided in the client theme, loaded via the idfive Component Library:

 - [idfive Component Library](https://bitbucket.org/idfivellc/idfive-component-library)
 - [idfive Component Library D8 Theme](https://bitbucket.org/idfivellc/idfive-component-library-d8-theme)

## Configuration

Provides the "Stat Group" and "Stats" paragraphs.

The following fields are available on the Stats Group KS widget:
 - Style: Light or Dark

The following fields are available on the Stat KS widget:
 - Value: The number value
 - Text: Accompaning text for the stat

## Markup Overrides
- You may override paragraphs templates by copying them into the client theme.
- You may override hooks by copying into client .theme, and modifying hook name/etc.
