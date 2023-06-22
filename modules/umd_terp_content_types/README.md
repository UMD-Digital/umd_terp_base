# UMD Terp Content Types

Provides various customizations and configurations for content types used in the "UMD Terp" theme.

This module contains markup only (no js or css), those should be provided in the UMD Terp Theme:

- [UMD Terp Theme](https://github.com/UMD-Digital/umd_terp)

## Configuration

Provides the following content types:

- UMD Terp Article: This is for local articles (not articles from UMD Today), such as Blog posts, etc.
- UMD Terp Basic Page: This is for creating most site content.
- UMD Terp Homepage: This content type is for creating the homepage. In certain instances, it may also be used to create specific landing pages/etc.
- UMD terp Person: This is for creating staff and faculty Bios.
- UMD terp Event: This is for creating local events.

Provides the following Taxonomies:

- Categories: This taxonomy holds categories for the UMD Terp Article content.
- Departments: This taxonomy holds departments for the UMD Terp Person content.

Provides the following views:

- Articles: A filterable list of articles. Can be added to any basic page via the ut_view module.
- Events: A simple list of events. Can be added to any basic page via the ut_view module.

### UMD Terp Article

The following fields are available on the UMD Terp Article:

- Title
- Subtitle: Optional subtitle.
- Author: Entity reference to UMD terp Person, for attributing authorship.
- Image: The main image associated with the article.
- Caption: A caption for the added image.
- Date: The desired publication date, for display purposes.
- Categories: Entity reference to the "Categories" vocabulary.
- Body: The main body text.
- Sections: Optional kitchen sink widgets.
- Metatags: You may use these fields to fine tune metatags, if desired.

### UMD Terp Basic Page

The following fields are available on the UMD Terp Basic Page:

- Title
- Body: The main body text.
- Hero Image: The main image associated with the article.
- Hide Sidebar: Option to hide sidebar so that the page can act more like a full width landing page.
- Sections: Optional kitchen sink widgets.
- Metatags: You may use these fields to fine tune metatags, if desired.

### UMD Terp Homepage

The following fields are available on the UMD Terp Homepage:

- Title
- Hero Style: Background or default.
- Hero Image: The main image in the hero.
- Hero Video: The main video in the hero.
- Hero Title: Main title in hero.
- Hero Subtitle: Subtitle in hero.
- Hero Text: Text in hero.
- Hero CTA: Call to action link.
- Sections: Optional kitchen sink widgets.
- Metatags: You may use these fields to fine tune metatags, if desired.

### UMD Terp Person

The following fields are available on the UMD Terp Person:

- Display Name: Full name of person.
- First Name: First name of person.
- Last Name: last name of person.
- Photo: Photo of person.
- Title: Persons title.
- Departments: Entity reference to the "Departments" vocabulary.
- Bio: Persons bio.
- Phone: Persons phone.
- Phone Ext: Phone extension, if required.
- Email: Persons email.
- Website: Persons website.
- Location: Building name on campus.
- Hero Image: Optional large image associated with the person.
- Body: Optional, additional text.
- Sections: Optional kitchen sink widgets.
- Metatags: You may use these fields to fine tune metatags, if desired.

### UMD Terp Event

The following fields are available on the UMD Terp Event:

- Event Name
- Image: The main image associated with the event.
- Caption: A caption for the added image.
- Start Date: The start date of the event.
- End Date: The end date of the event.
- Time: The event time.
- Description: The main body text.
- Event Link: Optional link to an event registration page/etc.
- Metatags: You may use these fields to fine tune metatags, if desired.

## Markup Overrides

- All templates reside within the umd_terp theme.
- You may override hooks by copying into client .theme, and modifying hook name/etc.
