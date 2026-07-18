Follow the project requirements exactly as described in:

- mercury-bangladesh-requirements.md
- mercury-bangladesh-design-guideline.md

Continue from the current project state.

Do NOT change any existing functionality, routing, CMS logic, database structure, API, or business logic.

Task:
Enhance the Home Page by adding new premium corporate sections. The new sections must seamlessly match the existing design, spacing, typography, color palette, and component style. Every new section must be fully responsive and completely manageable from the CMS.

## 1. CEO's Message Section

Add a new section titled **"Message from Our CEO"**.

Layout:
- Two-column layout on desktop.
- Stack vertically on mobile.
- CEO image on the left.
- Message content on the right.

Content:
- Small eyebrow title.
- Main heading: "Message from Our CEO"
- Rich text message.
- CEO Name.
- CEO Position.
- Optional handwritten-style signature image.
- Optional "Read More" button.

Image:
- Professional portrait.
- Rounded corners.
- Soft shadow.
- Fixed aspect ratio.
- Responsive.

Design:
- Premium corporate layout.
- Plenty of whitespace.
- Elegant typography.
- Orange quote icon above the message.
- Optional quotation mark background decoration with low opacity.
- White card with subtle shadow and border.

CMS Requirements:
- Upload/change CEO image.
- Edit message.
- Edit CEO name.
- Edit designation.
- Upload signature image.
- Toggle section visibility.
- Reorder section.

---

## 2. Image Gallery Section

Create a modern image gallery to showcase Mercury Bangladesh's operations.

Possible gallery content:
- Cargo Ships
- Containers
- Warehouse
- Freight Handling
- Office
- Team
- Logistics Operations
- Transportation

Layout:
- Responsive masonry or uniform grid.
- 2 columns on mobile.
- 3–5 columns on desktop depending on screen width.
- Equal spacing.
- Rounded images.
- Soft shadows.

Features:
- Hover zoom effect.
- Hover dark overlay.
- Optional image title.
- Lightbox popup on click.
- Smooth animations.

CMS Requirements:
- Add unlimited gallery images.
- Upload images.
- Edit titles.
- Reorder images using drag & drop.
- Enable/disable images.
- Delete images.

---

## 3. Large Call-To-Action Banner

Add a full-width banner immediately before the footer.

Purpose:
Encourage visitors to contact Mercury Bangladesh.

Layout:
- Full-width section.
- Large background image with dark navy overlay.
- Centered content both vertically and horizontally.

Content:
- Large headline.
- Supporting text.
- Primary CTA button.
- Secondary CTA button (optional).

Example CTA:
Headline:
"Moving Your Business Across the World with Confidence"

Description:
"Our experienced logistics team is ready to deliver reliable shipping solutions tailored to your business."

Buttons:
- Contact Us
- Request a Quote

Design:
- Large vertical padding.
- White text.
- Orange primary button.
- White outline secondary button.
- Subtle background overlay.
- Modern corporate appearance.
- Soft fade animation when entering viewport.

CMS Requirements:
- Upload/change background image.
- Edit heading.
- Edit description.
- Edit button text.
- Edit button links.
- Toggle section visibility.

---

## Section Placement

Update the Home Page layout in this order:

1. Hero Carousel
2. About Us
3. Vision & Mission
4. Why Choose Us
5. Feature Services
6. Statistics
7. CEO's Message (NEW)
8. Image Gallery (NEW)
9. Partners
10. Get in Touch
11. Full-width CTA Banner (NEW)
12. Footer

---

## Design Requirements

- Maintain the Dark Navy + Orange brand identity.
- Use the same spacing system throughout.
- Keep generous whitespace.
- Use subtle shadows on every card and component.
- Orange icons where appropriate.
- Navy headings.
- Professional typography.
- Smooth hover effects.
- Responsive on all screen sizes.
- Use reusable Vue components.
- Integrate every new section into the CMS using the existing dynamic section architecture.
- Do not hardcode any content.

Finally, review the Home Page to ensure the new sections feel like a natural part of the overall design and maintain a premium, modern corporate appearance.