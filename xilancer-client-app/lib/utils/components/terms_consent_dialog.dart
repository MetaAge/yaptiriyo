import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';

class TermsConsentDialog extends StatefulWidget {
  final VoidCallback onAccept;

  const TermsConsentDialog({super.key, required this.onAccept});

  @override
  State<TermsConsentDialog> createState() => _TermsConsentDialogState();
}

class _TermsConsentDialogState extends State<TermsConsentDialog> {
  bool accepted = false;

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      title: Text(
        "Sözleşme Onayı",
        style: context.titleMedium?.copyWith(fontWeight: FontWeight.bold),
      ),
      content: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          const Text(
            "Abonelik işleminize devam etmek için Mesafeli Satış Sözleşmesi ve Ön Bilgilendirme Formu'nu okuyup onaylamanız gerekmektedir.",
            textAlign: TextAlign.center,
          ),
          const SizedBox(height: 16),
          Row(
            children: [
              Checkbox(
                value: accepted,
                onChanged: (v) => setState(() => accepted = v ?? false),
                activeColor: context.dProvider.primaryColor,
              ),
              Expanded(
                child: GestureDetector(
                  onTap: () => setState(() => accepted = !accepted),
                  child: const Text(
                    "Mesafeli Satış Sözleşmesi'ni okudum ve onaylıyorum.",
                    style: TextStyle(fontSize: 12),
                  ),
                ),
              ),
            ],
          ),
        ],
      ),
      actions: [
        TextButton(
          onPressed: () => Navigator.pop(context),
          child: Text(LocalKeys.cancel, style: const TextStyle(color: Colors.grey)),
        ),
        ElevatedButton(
          onPressed: accepted
              ? () {
                  Navigator.pop(context);
                  widget.onAccept();
                }
              : null,
          style: ElevatedButton.styleFrom(
            backgroundColor: context.dProvider.primaryColor,
            foregroundColor: Colors.white,
            shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
          ),
          child: const Text("Onayla ve Devam Et"),
        ),
      ],
    );
  }
}
