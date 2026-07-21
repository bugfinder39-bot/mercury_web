import pages from './pages'
import sections from './sections'
import sectionItems from './section-items'
import services from './services'
import partners from './partners'
import messages from './messages'
import settings from './settings'
import layout from './layout'
import users from './users'
const admin = {
    pages: Object.assign(pages, pages),
sections: Object.assign(sections, sections),
sectionItems: Object.assign(sectionItems, sectionItems),
services: Object.assign(services, services),
partners: Object.assign(partners, partners),
messages: Object.assign(messages, messages),
settings: Object.assign(settings, settings),
layout: Object.assign(layout, layout),
users: Object.assign(users, users),
}

export default admin