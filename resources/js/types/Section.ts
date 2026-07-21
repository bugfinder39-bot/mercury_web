// src/types/Section.ts
export interface BaseSection {
    id: number;
    type: string;
    heading?: string;
    subheading?: string;
    body?: string;
    order: number;
    is_active: boolean;
}

export interface CEOMessageSection extends BaseSection {
    type: 'ceo_message';
    imageUrl: string;
    eyebrow?: string;
    heading?: string;
    messageHtml: string;
    name: string;
    position: string;
    signatureUrl?: string;
    ctaText?: string;
    ctaLink?: string;
    show_ceo_image?: boolean | number;
}

export interface ImageGallerySection extends BaseSection {
    type: 'image_gallery';
    items?: any[];
}

export type Section = CEOMessageSection | ImageGallerySection | BaseSection;
