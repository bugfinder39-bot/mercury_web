import dashboardWidgets from './dashboard-widgets'
import pages from './pages'
import sections from './sections'
import sectionItems from './section-items'
import services from './services'
import partners from './partners'
import globalNetwork from './global-network'
import certifications from './certifications'
import exchangeRates from './exchange-rates'
import announcements from './announcements'
import messages from './messages'
import settings from './settings'
import layout from './layout'
import users from './users'
const admin = {
    dashboardWidgets: Object.assign(dashboardWidgets, dashboardWidgets),
pages: Object.assign(pages, pages),
sections: Object.assign(sections, sections),
sectionItems: Object.assign(sectionItems, sectionItems),
services: Object.assign(services, services),
partners: Object.assign(partners, partners),
globalNetwork: Object.assign(globalNetwork, globalNetwork),
certifications: Object.assign(certifications, certifications),
exchangeRates: Object.assign(exchangeRates, exchangeRates),
announcements: Object.assign(announcements, announcements),
messages: Object.assign(messages, messages),
settings: Object.assign(settings, settings),
layout: Object.assign(layout, layout),
users: Object.assign(users, users),
}

export default admin