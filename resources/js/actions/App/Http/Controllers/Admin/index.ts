import DashboardController from './DashboardController'
import DashboardWidgetController from './DashboardWidgetController'
import PageController from './PageController'
import ServiceController from './ServiceController'
import PartnerController from './PartnerController'
import NetworkLocationController from './NetworkLocationController'
import CertificationController from './CertificationController'
import ExchangeRateController from './ExchangeRateController'
import AnnouncementController from './AnnouncementController'
import MessageController from './MessageController'
import SettingController from './SettingController'
import LayoutController from './LayoutController'
import UserController from './UserController'
const Admin = {
    DashboardController: Object.assign(DashboardController, DashboardController),
DashboardWidgetController: Object.assign(DashboardWidgetController, DashboardWidgetController),
PageController: Object.assign(PageController, PageController),
ServiceController: Object.assign(ServiceController, ServiceController),
PartnerController: Object.assign(PartnerController, PartnerController),
NetworkLocationController: Object.assign(NetworkLocationController, NetworkLocationController),
CertificationController: Object.assign(CertificationController, CertificationController),
ExchangeRateController: Object.assign(ExchangeRateController, ExchangeRateController),
AnnouncementController: Object.assign(AnnouncementController, AnnouncementController),
MessageController: Object.assign(MessageController, MessageController),
SettingController: Object.assign(SettingController, SettingController),
LayoutController: Object.assign(LayoutController, LayoutController),
UserController: Object.assign(UserController, UserController),
}

export default Admin