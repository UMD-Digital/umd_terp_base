# UMD Terp Paragraphs: News Feed

Paragraphs integration of a News Feed (from calendar.umd.edu) for UMD projects. Essentially, this module pulls a feed of articles from hub.umd.edu, with optional filter paramaters available, in order to highlight relevant articles.

This module contains markup only (no js or css), those should be provided in the UMD Terp Theme:

- [UMD Terp Theme](https://github.com/UMD-Digital/umd_terp)

## Configuration

The following fields are available on this KS widget:

- Style: Light or Dark
- Title: Sets the title in the header bar. Defaults to "News".
- View All Link: Sets the link at the bottom of the feed to a specific page on umd.today, if needed.
- Destination: Filters articles by the Destination taxonomy in the HUB.
- Audience: Filters articles by the Audience taxonomy in the HUB.
- Messaging Area: Filters articles by the Messaging Area taxonomy in the HUB.
- Priorites and Initiatives: Filters articles by the Priorites and Initiatives taxonomy in the HUB.
- Colleges and Schools: Filters articles by the Colleges and Schools taxonomy in the HUB.
- Topics: Filters articles by the Topics taxonomy in the HUB.

## Notes on news feed filtering

If no optional filters are chosen, it will show a default feed.

These filters are additive, meaning they will combine if you choose more than one. For example, if both "Destination" and "Schools and Colleges" are chosen, the query would say "Give me all articles tagged as catergory=x AND schools_and_colleges=y". Usually, only one should be chosen in order to have articles refresh at a better rate.

More information and documentation on the articles API can be found in the HUB.

## Markup Overrides

- You may override paragraphs templates by copying them into the client theme.
- You may override hooks by copying into client .theme, and modifying hook name/etc.
