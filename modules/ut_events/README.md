# UMD Terp Paragraphs: Events Feed

Paragraphs integration of an Events Feed (from calendar.umd.edu) for UMD projects. Essentially, this module pulls a feed of upcoming events from calendar.umd.edu, with optional filter paramaters available, in order to highlight relevant events.

This module contains markup only (no js or css), those should be provided in the UMD Terp Theme:

- [UMD Terp Theme](https://github.com/UMD-Digital/umd_terp)

## Configuration

The following fields are available on this KS widget:

- Style: Light or Dark
- Title: Sets the title in the header bar. Defaults to "Events".
- View All Link: Sets the link at the bottom of the feed to a specific page on the calendar, if needed.
- Campus Locations: Filters events by the Campus Location taxonomy in calendar.umd.
- Campus Unit: Filters events by the Campus Unit taxonomy in calendar.umd.
- Location Type: Filters events by the Location Type taxonomy in calendar.umd.
- Tags: Filters events by the Tags taxonomy in calendar.umd.

## Notes on event feed filtering

The feed is set to show events happening today or after. While there may be some lag time/caching, generally speaking it does not show past events. If no optional filters are chosen, it will show a default feed.

These filters are additive, meaning they will combine if you choose more than one. For example, if both "Campus Units" and "Tags" are chosen, the query would say "Give me all events tagged as campus_unit=x AND tag=y". Usually, only one should be chosen in order to have events refresh at a better rate.

More information and documentation on the API can be found:

- [Graph QL Staging Endpoint](https://umd-calendar-staging.cl-umd-edu-1.servd.dev/admin/graphiql) can be used for testing.
- [UMD Today wiki](https://github.com/UMD-Digital/today/wiki/Documentation#get-articles-by-category) This is for articles, but APIU endpoint mostly thhe same as events, so helpful reference.
- [UMD Digital JS custom feed](https://github.com/UMD-Digital/elements-calendar-feed) is a JS based example, and you can see some helpful API call code in there.

## Markup Overrides

- You may override paragraphs templates by copying them into the client theme.
- You may override hooks by copying into client .theme, and modifying hook name/etc.
