class AppStatusModel {
  final bool maintenanceMode;
  final String maintenanceMessage;
  final String androidVersion;
  final String iosVersion;
  final bool forceUpdate;
  final String status;

  AppStatusModel({
    required this.maintenanceMode,
    required this.maintenanceMessage,
    required this.androidVersion,
    required this.iosVersion,
    required this.forceUpdate,
    required this.status,
  });

  factory AppStatusModel.fromJson(Map<String, dynamic> json) {
    return AppStatusModel(
      maintenanceMode: json['maintenance_mode'] ?? false,
      maintenanceMessage: json['maintenance_message'] ?? '',
      androidVersion: json['android_version'] ?? '1.0.0',
      iosVersion: json['ios_version'] ?? '1.0.0',
      forceUpdate: json['force_update'] ?? false,
      status: json['status'] ?? 'error',
    );
  }
}
