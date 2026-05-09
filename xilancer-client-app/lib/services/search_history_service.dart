import 'package:shared_preferences/shared_preferences.dart';

class SearchHistoryService {
  static final SearchHistoryService instance = SearchHistoryService._();
  SearchHistoryService._();

  static const String _key = 'recent_searches';

  Future<List<String>> getHistory() async {
    final prefs = await SharedPreferences.getInstance();
    return prefs.getStringList(_key) ?? [];
  }

  Future<void> addSearch(String query) async {
    if (query.trim().isEmpty) return;
    final prefs = await SharedPreferences.getInstance();
    List<String> history = prefs.getStringList(_key) ?? [];
    
    history.remove(query);
    history.insert(0, query);
    
    if (history.length > 10) {
      history = history.sublist(0, 10);
    }
    
    await prefs.setStringList(_key, history);
  }

  Future<void> clearHistory() async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.remove(_key);
  }
}
