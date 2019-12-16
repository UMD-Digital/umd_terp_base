# UMD Terp Paragraphs: Events Feed

Paragraphs integration of an Events Feed (from calendar.umd.edu) for UMD projects. Essentially, this module pulls a feed of upcoming events from hub.umd.edu, with optional filter paramaters available, in order to highlight relevant events.

This module contains markup only (no js or css), those should be provided in the UMD Terp Theme:

- [UMD Terp Theme](https://github.com/UMD-Digital/umd_terp)

## Configuration

The following fields are available on this KS widget:

- Style: Light or Dark
- Title: Sets the title in the header bar. Defaults to "Events".
- View All Link: Sets the link at the bottom of the feed to a specific page on the calendar, if needed.
- Destination: Filters events by the Destination taxonomy in the HUB.
- Event Type: Filters events by the Event Type taxonomy in the HUB.
- Messaging Area: Filters events by the Messaging Area taxonomy in the HUB.
- Priorites and Initiatives: Filters events by the Priorites and Initiatives taxonomy in the HUB.
- Colleges and Schools: Filters events by the Colleges and Schools taxonomy in the HUB.

## Notes on event feed filtering

The feed is set to show events happening today or after. While there may be some lag time/caching, generally speaking it does not show past events. If no optional filters are chosen, it will show a default feed.

These filters are additive, meaning they will combine if you choose more than one. For example, if both "Destination" and "Schools and Colleges" are chosen, the query would say "Give me all events tagged as catergory=x AND schools_and_colleges=y". Usually, only one should be chosen in order to have events refresh at a better rate.

More information and documentation on the adv_events API can be found in the HUB.

## Markup Overrides

- You may override paragraphs templates by copying them into the client theme.
- You may override hooks by copying into client .theme, and modifying hook name/etc.
