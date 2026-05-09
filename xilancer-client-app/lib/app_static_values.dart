import 'package:xilancer/helper/local_keys.g.dart';

List<String> experienceLevels = [
  "senior",
  "midLevel",
  "junior",
];
List<String> jobType = [
  "senior",
  "midLevel",
  "junior",
  "not mandatory",
];

List<String> jobLengths = [
  LocalKeys.oneDay,
  LocalKeys.twoDays,
  LocalKeys.threeDays,
  LocalKeys.lessThanAWeek,
  LocalKeys.lessThanAMonth,
  LocalKeys.lessThan2Months,
  LocalKeys.lessThan3Months,
  LocalKeys.moreThan3Months,
];

List<String> supportedFileTypesInC = [
  "png",
  "jpg",
  "jpeg",
  "pdf",
  "gif",
];

List<String> offerStatus = [
  LocalKeys.pending,
  LocalKeys.accepted,
  LocalKeys.declined
];

enum Status {
  LOADING,
  NOT_INITIATED,
  NOT_AVAILABLE,
  INVALID,
  AVAILABLE,
}
